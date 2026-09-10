# syntax=docker/dockerfile:1

# ---------------------------------------------------------------- assets
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund
COPY . .
RUN npm run build

# ---------------------------------------------------------------- vendor
FROM composer:2 AS vendor
WORKDIR /app
COPY . .
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# ---------------------------------------------------------------- runtime
FROM php:8.2-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev libjpeg62-turbo-dev libzip-dev libicu-dev \
        libonig-dev libpq-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" gd intl zip pdo_mysql pdo_pgsql mbstring exif opcache \
    && a2enmod rewrite headers \
    && sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
COPY docker/php.ini /usr/local/etc/php/conf.d/deploy.ini
COPY docker/start.sh /usr/local/bin/start.sh

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod +x /usr/local/bin/start.sh \
    && mkdir -p storage/framework/sessions storage/framework/cache storage/framework/views

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
#!/bin/sh
set -e

# Laravel bootstrapping at container start
php artisan package:discover --ansi

if [ ! -L storage/app/public ]; then
    php artisan storage:link
fi

php artisan migrate --force --no-interaction

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec apache2-foreground
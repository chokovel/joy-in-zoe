#!/bin/sh
set -e

# Render routes traffic to the $PORT env (default 10000), not 80.
# Bind Apache to that port, defaulting to 80 outside Render.
export PORT="${PORT:-80}"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf 2>/dev/null || true

# Write our vhost directly at every boot, bound to the actual $PORT.
# conf-enabled/ is always included by Debian's apache2.conf and loads
# BEFORE sites-enabled/, so this is the default server for $PORT with no
# reliance on a2ensite/symlink state.
cat > /etc/apache2/conf-enabled/000-joy-in-zoe.conf <<VHOST
<VirtualHost *:${PORT}>
    ServerName localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        DirectoryIndex index.php
        Options -Indexes +FollowSymLinks
        AllowOverride None
        Require all granted
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_URI} (.+)/$
        RewriteRule ^ %1 [L,R=301]
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [L]
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
VHOST

# Boot-time diagnostics - confirms which vhost/docroot is actually loaded.
echo ">>> Port configured for Apache: ${PORT}"
echo ">>> Effective vhost (conf-enabled):"
grep -E "VirtualHost|DocumentRoot|DirectoryIndex|ServerName" /etc/apache2/conf-enabled/000-joy-in-zoe.conf 2>/dev/null || true
echo ">>> sites-enabled:"
ls -la /etc/apache2/sites-enabled/ 2>/dev/null || true
echo ">>> public dir:"
ls -la /var/www/html/public 2>/dev/null | head -15 || true
test -f /var/www/html/public/index.php && echo ">>> public/index.php PRESENT" || echo ">>> public/index.php MISSING (fatal)"
echo ">>> Boot diagnostics end."

# Laravel bootstrapping at container start
php artisan package:discover --ansi 2>/dev/null || true

if [ ! -L storage/app/public ]; then
    php artisan storage:link
fi

php artisan migrate --force --no-interaction

# Cache what we can; never let a cache failure crash the boot.
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Reproduce the home route once inside the container so any production-only
# exception is written into the deploy log.
echo ">>> Home route self-test:"
php /var/www/html/docker/selftest.php 2>&1 || true
echo ">>> Laravel log tail:"
tail -n 60 /var/www/html/storage/logs/laravel.log 2>/dev/null || echo "(laravel.log missing)"
echo ">>> Boot complete."

exec apache2-foreground
#!/bin/sh
set -e

# Render routes traffic to the $PORT env (default 10000), not 80.
# Bind Apache to that port, defaulting to 80 outside Render.
export PORT="${PORT:-80}"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf

# Boot-time diagnostics - confirms which vhost/docroot is actually loaded.
echo ">>> Effective Apache config:"
grep -rhE "^\s*(DocumentRoot|DirectoryIndex|ServerName)" /etc/apache2/sites-enabled/ 2>/dev/null
echo ">>> public dir:"
ls -la /var/www/html/public 2>/dev/null | head -15
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

exec apache2-foreground
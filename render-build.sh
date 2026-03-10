#!/bin/sh
set -e
cd /var/www

# Configure Apache port dynamically based on Render's PORT environment variable
sed -i "s/80/${PORT:-8080}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs
chmod -R 775 storage bootstrap/cache
php artisan migrate --seed --force --no-interaction
php artisan storage:link || true

# Cache configs, routes and views for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache in the foreground
exec apache2-foreground

#!/bin/sh
set -e

echo "Starting deployment script..."

if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set."
    exit 1
fi

cd /var/www

PORT="${PORT:-8080}"
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

echo "Preparing storage and cache..."
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs
mkdir -p /tmp/views
chmod -R 777 /tmp/views
chmod -R 777 storage/framework/cache
chmod -R 777 storage/framework/views
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chown -R www-data:www-data /tmp/views

echo "Clearing old caches..."
php artisan view:clear || true

echo "Running migrations..."
php artisan migrate --seed --force --no-interaction

echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache || true

chmod -R 777 storage/framework/views || true
chmod -R 777 /tmp/views || true
php artisan storage:link || true

echo "Starting Apache..."
exec apache2-foreground
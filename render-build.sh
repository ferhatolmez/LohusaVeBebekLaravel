#!/bin/sh
set -e

echo "Starting deployment script..."

# Check for APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY is not set. Please add it to your Render Environment Variables."
    exit 1
fi

cd /var/www

# Configure Apache port dynamically based on Render's PORT environment variable
PORT="${PORT:-8080}"
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

echo "Preparing storage and cache..."
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "Clearing old caches..."
php artisan view:clear
php artisan cache:clear

echo "Running migrations..."
php artisan migrate --seed --force --no-interaction

echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan config:clear

# Extra step for robustness if views are still problematic
chmod -R 777 storage/framework/views || true

# Clear and link storage
php artisan storage:link || true

echo "Starting Apache..."
exec apache2-foreground

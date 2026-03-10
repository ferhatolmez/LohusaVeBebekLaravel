#!/bin/sh
set -e
cd /var/www
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs
chmod -R 775 storage bootstrap/cache
php artisan migrate --seed --force --no-interaction
php artisan storage:link || true
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"

#!/bin/bash
set -e

echo "==> Starting Laravel 13 Production Container..."

# Ensure storage directories exist
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/database

# Ensure SQLite file exists
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    echo "==> Created fresh SQLite database: database/database.sqlite"
fi

# Ensure correct permissions for www-data
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod 664 /var/www/html/database/database.sqlite

# Clean any stale bootstrap caches
rm -f /var/www/html/bootstrap/cache/packages.php /var/www/html/bootstrap/cache/services.php

# Create storage symlink
php artisan storage:link --force 2>/dev/null || true

# Discover production packages
php artisan package:discover --ansi

# Run database migrations
echo "==> Running database migrations..."
php artisan migrate --force

# Warm up Laravel production caches
echo "==> Warming up production caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Application ready. Launching PHP-FPM..."
exec "$@"

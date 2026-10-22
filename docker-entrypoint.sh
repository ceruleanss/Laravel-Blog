#!/bin/bash
set -e

export COMPOSER_PROCESS_TIMEOUT=0

# Ensure directories exist and are writable
mkdir -p /var/www/html/database
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs

chmod -R 777 /var/www/html/bootstrap/cache /var/www/html/storage 2>/dev/null || true

# Ensure SQLite database file exists
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
    echo "Created database/database.sqlite"
fi

# Ensure .env exists
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
    echo "Copied .env.example to .env"
fi

# Install composer dependencies if autoload.php or framework does not exist
if [ ! -f /var/www/html/vendor/autoload.php ] || [ ! -f /var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Application.php ]; then
    echo "Installing Composer dependencies (process-timeout=0)..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Generate APP_KEY if empty
if ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    php artisan key:generate --force
fi

# Ensure storage link exists
php artisan storage:link --force 2>/dev/null || true

# Execute migrations and seeders if tables don't exist
php artisan migrate --force

exec "$@"

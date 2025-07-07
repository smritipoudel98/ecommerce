#!/bin/sh
set -e

# Wait for database
if [ -n "$DB_HOST" ]; then
  echo "Waiting for database..."
  while ! nc -z $DB_HOST $DB_PORT; do
    sleep 1
  done
  echo "Database ready!"
fi

# Install dependencies if needed
if [ ! -d "vendor" ]; then
  composer install --no-interaction --optimize-autoloader --no-scripts
fi

# Generate key if not set
if [ -z "$(grep '^APP_KEY=base64' .env)" ]; then
  php artisan key:generate
fi

# Run Laravel setup
php artisan config:cache
php artisan migrate --force
php artisan storage:link

# Fix permissions
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache

exec php-fpm
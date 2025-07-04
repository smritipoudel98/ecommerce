# entrypoint.sh is a shell script that runs automatically when your Docker container starts.

#!/bin/sh

# Wait for MySQL or PostgreSQL to be ready
echo "Waiting for database..."
sleep 10

# Install Composer dependencies
composer install

# Run Laravel setup
php artisan config:cache
php artisan migrate --force
# Applies database migrations (without asking for confirmation).

php artisan storage:link
# Links the storage folder to public/storage. Needed for file uploads.

# Set permissions (optional)
chown -R www-data:www-data /var/www
#Makes sure the web server (PHP-FPM) owns all Laravel files.

# Start PHP-FPM
php-fpm

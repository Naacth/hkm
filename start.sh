#!/bin/bash

# Make sure database directory exists
mkdir -p /var/www/html/database

# Create SQLite database if it doesn't exist
if [ ! -f /var/www/html/database/database.sqlite ]; then
    touch /var/www/html/database/database.sqlite
fi

# Set proper permissions
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/database

# Set proper permissions for storage and cache
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache views
php artisan view:clear
php artisan view:cache

# Run migrations
php artisan migrate --force

# Start Apache
apache2-foreground

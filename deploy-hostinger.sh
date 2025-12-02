#!/bin/bash

echo "=== Hostinger Deployment Script ==="

# Install/Update Composer dependencies with platform requirements ignored
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs --no-scripts

# Check if composer install was successful
if [ $? -ne 0 ]; then
    echo "Composer install failed, trying alternative method..."
    composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-req=ext-gd --ignore-platform-req=ext-imagick --no-scripts
fi

# Generate autoload files
echo "Generating autoload files..."
composer dump-autoload --optimize --no-dev

# Clear all caches
echo "Clearing caches..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true

# Run migrations
echo "Running migrations..."
php artisan migrate --force 2>/dev/null || echo "Migration skipped or failed"

# Cache config for production
echo "Caching configuration..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Create necessary directories
echo "Creating upload directories..."
mkdir -p public/uploads/certificates/manual
mkdir -p public/uploads/certificates/generated
mkdir -p public/uploads/certificates/batch
mkdir -p public/uploads/events
mkdir -p public/uploads/products
mkdir -p public/uploads/qris

# Set permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache 2>/dev/null || true
chmod -R 775 storage bootstrap/cache public/uploads 2>/dev/null || true

echo "=== Deployment completed! ==="

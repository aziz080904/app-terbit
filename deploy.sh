#!/bin/bash
cd C:/xampp/htdocs/app-terbit

# Install composer dependencies
composer install --optimize-autoloader --no-dev

# Install npm dependencies
npm install
npm run prod

# Set permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Cache Laravel configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Deployment complete!"
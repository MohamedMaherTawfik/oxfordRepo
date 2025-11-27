#!/bin/bash

# Script to optimize website file sizes

echo "Starting optimization..."

# Remove temporary files
echo "Removing temporary files..."
find storage/app/private/tmp -type f -name "*.mp4" -mtime +1 -delete 2>/dev/null
find storage/app/public/lessonsVideo/tmp -type f -name "*.mp4" -mtime +1 -delete 2>/dev/null

# Clear Laravel cache
echo "Clearing Laravel cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize autoloader
echo "Optimizing autoloader..."
composer dump-autoload --optimize --no-dev

echo "Optimization complete!"


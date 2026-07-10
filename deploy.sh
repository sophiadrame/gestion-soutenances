#!/usr/bin/env bash
composer install --no-dev --optimize-autoloader --ignore-platform-reqs
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
php artisan migrate --force
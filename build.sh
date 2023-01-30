#!/usr/bin/env bash

set -o errexit

composer install --optimize-autoloader --no-dev

php artisan config:cache
php artisan route:cache
php artisan view:cache

# vite is a dev dependency
npm install
npm run build
npm prune --production

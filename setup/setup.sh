#!/usr/bin/env bash

composer install
npm install
npm run build
npm run dev
set .env database
php artisan migrate
#!/bin/sh

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

if [ ! -d "node_modules" ]; then
    npm install
fi

if [ ! -d "vendor" ]; then
    composer install --no-interaction --prefer-dist
fi

sleep 15

php artisan key:generate

php artisan migrate

php artisan app:sincronizar-dados

npm run build

php artisan serve --host=0.0.0.0 --port=8000
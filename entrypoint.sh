#!/bin/bash

# Sprawdź, czy plik .env istnieje
if [ ! -f /var/www/html/.env ]; then
  cp /var/www/html/.env.example /var/www/html/.env
fi

# Zaktualizuj plik .env z konfiguracją bazy danych
sed -i "s/DB_HOST=.*/DB_HOST=db/" /var/www/html/.env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=laravel_db/" /var/www/html/.env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=laravel_user/" /var/www/html/.env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=laravel_password/" /var/www/html/.env

# Wykonaj migracje
php artisan migrate --force

# Uruchom Apache
exec apache2-foreground

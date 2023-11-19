
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction

cp .env.example .env

php artisan key:generate

php-fpm

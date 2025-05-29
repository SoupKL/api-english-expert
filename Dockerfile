FROM php:8.2

# Установка зависимостей
RUN apt-get update && apt-get install -y libpq-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN php artisan config:clear && php artisan route:clear

EXPOSE 10000

# 👇 Laravel слушает на 0.0.0.0:10000
CMD php artisan serve --host=0.0.0.0 --port=10000

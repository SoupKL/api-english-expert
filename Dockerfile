FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install --optimize-autoloader --no-dev

# Генерация ключа — Laravel требует .env
COPY .env.example .env
RUN php artisan key:generate

# Laravel listen на 0.0.0.0:8080
EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=8080

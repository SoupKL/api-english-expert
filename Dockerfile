FROM php:8.2-fpm

# Устанавливаем зависимости, включая поддержку PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip curl git \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Установка Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Устанавливаем зависимости Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]

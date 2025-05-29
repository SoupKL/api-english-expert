FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    libpq-dev \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Установка рабочего каталога
WORKDIR /var/www

# Копирование файлов
COPY . .

# Установка зависимостей Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Настройка прав
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Установка точки входа
CMD ["php-fpm"]
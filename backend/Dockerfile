FROM composer:2.6 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction

FROM php:8.2-fpm
WORKDIR /var/www/html

COPY --from=vendor /app/vendor ./vendor
COPY . .

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

CMD ["php-fpm"]
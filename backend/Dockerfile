FROM composer:2.6 AS vendor

WORKDIR /app

COPY composer.json ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-scripts \
    --optimize-autoloader

# ================================
# 2. Build PHP App
# ================================
FROM php:8.4-fpm-alpine AS app

WORKDIR /var/www/html

RUN apk update && apk add --no-cache \
    git \
    zip \
    unzip \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    libzip-dev \
    && docker-php-ext-install \
        pdo_mysql mbstring zip exif pcntl bcmath gd

COPY --from=vendor /app/vendor ./vendor

COPY . .

RUN php artisan config:cache || true && \
    php artisan route:cache || true && \
    php artisan view:cache || true

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
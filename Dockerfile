
# Stage 1: Install PHP dependencies
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-scripts

COPY . .
RUN composer dump-autoload --optimize --no-dev

# Stage 2: Build frontend assets
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

# Stage 3: Run Laravel with PHP-FPM
FROM php:8.3-fpm-bookworm AS app

RUN apt-get update && apt-get install -y --no-install-recommends \
    libicu-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql intl zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY --from=vendor --chown=www-data:www-data /app /var/www/html
COPY --from=frontend --chown=www-data:www-data /app/public/build /var/www/html/public/build

RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

USER www-data

EXPOSE 9000

CMD ["php-fpm"]


# Stage 4: Serve the Laravel public files with Nginx
FROM nginx:1.28-alpine AS web
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=app /var/www/html/public /var/www/html/public
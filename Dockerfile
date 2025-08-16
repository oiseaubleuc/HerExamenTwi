FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress
COPY . .
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

RUN apk add --no-cache git curl icu-dev oniguruma-dev libzip-dev zlib-dev sqlite-dev \
    && docker-php-ext-install pdo_mysql pdo_sqlite bcmath intl opcache \
    && rm -rf /var/cache/apk/*

COPY --chown=www-data:www-data . .
COPY --from=vendor /app/vendor /var/www/html/vendor
COPY --from=assets /app/public/build /var/www/html/public/build

RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

ENV APP_ENV=production \
    APP_DEBUG=false
EXPOSE 9000
CMD ["php-fpm"]

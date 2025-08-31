FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite-dev \
    icu-dev

RUN docker-php-ext-install pdo_sqlite intl opcache bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.* ./
RUN composer install --no-scripts --no-autoloader

COPY . .
RUN composer dump-autoload --optimize

RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
FROM php:8.3-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

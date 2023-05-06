FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /home/nomads

COPY . .

RUN composer install
RUN php artisan key:generate
RUN php artisan storage:link

CMD php artisan serve --host=0.0.0.0 --port=8000
FROM php:apache

RUN apt-get update && apt-get install -y \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libpq-dev \
    zip \
    nano \
    mlocate \
    && docker-php-ext-install -j$(nproc) iconv gd zip bcmath mysqli pdo pdo_mysql \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

RUN a2enmod rewrite
RUN service apache2 restart

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www

COPY ../../../api/. /var/www
RUN rm -R html && mv public html

RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN chmod -R  0777 storage
FROM php:8.2-fpm-buster

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apt-get update && apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN apt-get install -y autoconf pkg-config libssl-dev
RUN pecl install mongodb


# install mongodb-org-tools - mongodb tools for up-to-date mongodb that can handle --uri=mongodb+srv: flag
#RUN apt-get update && apt-get install -y gnupg software-properties-common && \
    #curl -fsSL https://www.mongodb.org/static/pgp/server-4.2.asc | apt-key add - && \
    #add-apt-repository 'deb https://repo.mongodb.org/apt/debian buster/mongodb-org/4.2 main' && \
    #apt-get update && \
    #apt-get install -y mongodb-org-tools

RUN docker-php-ext-configure gd --with-jpeg --with-freetype 

RUN docker-php-ext-install \
    pdo pdo_mysql zip xsl gd intl opcache exif mbstring

COPY . /var/www/html/

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/var


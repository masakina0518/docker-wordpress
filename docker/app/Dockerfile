FROM php:7.3-fpm-alpine

# install packages
RUN apk add -U --no-cache \
    bash \
    git \
    curl-dev \
    libxml2-dev \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    zip \
    libzip-dev \
    unzip \
    gmp-dev \
    autoconf \
    make \
    gcc \
    g++

# install PHP extensions
RUN docker-php-source extract
RUN cp /usr/src/php/ext/openssl/config0.m4 /usr/src/php/ext/openssl/config.m4
RUN docker-php-ext-configure gd --with-png-dir=/usr/include --with-jpeg-dir=/usr/include
RUN docker-php-ext-install pdo\
    pdo_mysql \
    mysqli \
    pdo_pgsql \
    pgsql \
    mbstring \
    curl \
    ctype \
    xml \
    json \
    tokenizer \
    openssl \
    gd \
    zip \
    gmp \
    bcmath \ 
    exif 

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN mv "/usr/local/etc/php/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY ./00-settings.ini "$PHP_INI_DIR/conf.d/00-settings.ini"

# ---------------------------------------

RUN apk add --update nodejs npm

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

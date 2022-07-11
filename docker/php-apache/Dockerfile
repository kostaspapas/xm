FROM php:7.3-apache

USER root

# Install dependencies & clean cache in one step
RUN apt-get update  \
&& apt-get install -y \
    build-essential \
    libbz2-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libpng-dev \
    libicu-dev \
    libreadline-dev \
    locales \
    zip \
    unzip \
    git \
    sudo \
    curl \
    g++ \
&& apt-get clean  \
&& rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    bcmath \
    bz2 \
    calendar \
    iconv \
    intl \
    mbstring \
    opcache \
    pdo_mysql \
    zip \
    exif \
    pcntl \
    sockets \
    gd

# Change the document root of apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add user for laravel application
RUN (groupadd -f -g 1000 www  && useradd -u 1000 -ms /bin/bash -g www www) || echo "User 'www' already exists."

# Set working directory
WORKDIR /var/www

# chown on the directory only , copy command does not chown the directory itself
RUN chown www:www /var/www

# Change current user to www
USER www

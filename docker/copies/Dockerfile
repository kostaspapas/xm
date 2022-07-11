FROM php:7.4-apache
RUN apt-get update -y && apt-get install -y gnupg2
RUN echo deb http://apt.postgresql.org/pub/repos/apt/ focal-pgdg main > /etc/apt/sources.list.d/pgdg.list
RUN curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add -
RUN apt-get update -y && apt-get install -y postgresql-client-12

RUN apt-get update -y && apt-get install -y \
        apt-utils \
        libzip-dev \
        zip \
        curl \
        libpng-dev \
        zlib1g-dev  \
        libpq-dev \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql pgsql zip \
    && docker-php-ext-configure zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN apt-get install -y libyaml-dev
RUN pecl install yaml && docker-php-ext-enable yaml
RUN a2enmod rewrite
RUN cd /var/www/html && ls -la

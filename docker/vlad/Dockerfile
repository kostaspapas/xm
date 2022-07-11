FROM php:7.3-apache

USER root
  
  # Install dependencies & clean cache in one step
RUN apt-get update && apt-get install -y \
build-essential \
libzip-dev \
libonig-dev \
locales \
zip \
unzip \
git \
curl \
libicu-dev && apt-get clean && rm -rf /var/lib/apt/lists/*
  
  # Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl sockets intl

RUN docker-php-source extract \
&& curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/3.0.0.tar.gz \
&& tar xfz /tmp/redis.tar.gz \
&& rm -r /tmp/redis.tar.gz \
&& mv phpredis-3.0.0 /usr/src/php/ext/redis \
&& docker-php-ext-install redis
  
  # Install composer
COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer
  
  # Add user for laravel application
RUN (groupadd -f -g 1000 www  && useradd -u 1000 -ms /bin/bash -g www www) || echo "User 'www' already exists."
  
  # Set working directory
WORKDIR /var/www
  
  # chown on the directory only , copy command does not chown the directory itself
RUN chown www:www /var/www
  
  # Change current user to www
USER www

COPY ./docker/app/local.ini /usr/local/etc/php/conf.d/local.ini
  
  # Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

FROM php:8.1-apache

# update OS
RUN apt-get -y update

# install git
RUN apt-get -y install git

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# apache configuration
COPY config/apache-virtual-host.conf /etc/apache2/sites-available/000-default.conf

# enable nice url
RUN a2enmod rewrite

# install postgresql database driver
RUN apt-get -y install libpq-dev \
  && docker-php-ext-install pdo_pgsql

# install additional supported languages for liveCoding appart from php
# HTML + CSS by default of Apache
# PHP by default by this image
RUN apt-get -y install python3 # Python3
RUN apt-get -y install nodejs # JavaScript

WORKDIR /var/www/html
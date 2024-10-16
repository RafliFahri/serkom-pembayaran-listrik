FROM php:8.2.11-fpm


# Install Composer
RUN echo "Install COMPOSER"
RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php


# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql


# Update package manager and install useful tools
RUN apt-get update && apt-get -y install apt-utils nano wget dialog vim


# Install important libraries
RUN echo "Install important libraries"
RUN apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev

# Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# Add any additional configurations or adjustments as needed


# Set the working directory
WORKDIR /var/www


# Expose the port
EXPOSE 9000


# Define the entry point
CMD ["php-fpm"]









#FROM php:8.2-fpm
#
## Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/
#
## Set working directory
#WORKDIR /var/www
#
## Install dependencies
#RUN apt-get update && apt-get install -y \
#    build-essential \
#    libpng-dev \
#    libjpeg62-turbo-dev \
#    libfreetype6-dev \
#    locales \
#    zip \
#    jpegoptim optipng pngquant gifsicle \
#    vim \
#    unzip \
#    git \
#    curl
#
## Clear cache
#RUN apt-get clean && rm -rf /var/lib/apt/lists/*
#
## Install extensions
#RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
#RUN docker-php-ext-install gd
#
## Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
## Add user for laravel application
#RUN groupadd -g 1000 www
#RUN useradd -u 1000 -ms /bin/bash -g www www
#
## Copy existing application directory contents
#COPY . /var/www
#
## Copy existing application directory permissions
#COPY --chown=www:www . /var/www
#
## Change current user to www
#USER www
#
## Expose port 9000 and start php-fpm server
#EXPOSE 9000
#CMD ["php-fpm"]
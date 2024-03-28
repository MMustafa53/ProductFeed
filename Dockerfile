# Base image for PHP-FPM 8.0 with Nginx
FROM php:8.0-fpm

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Set working directory
WORKDIR /var/www/html

# Copy Nginx configuration file
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Copy PHP application files to container
COPY . /var/www/html

# Install necessary tools and PHP
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libssl-dev \
    pkg-config \
    wget \
    curl \
    unzip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-ext-install curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN wget -O composer-setup.php https://getcomposer.org/installer

# Install Composer
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm composer-setup.php

# Check Composer version
RUN composer --version

# Install project dependencies using Composer
RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs

# Generate autoload files
RUN composer dump-autoload --optimize

# Clean up
RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Expose port 80 for Nginx
EXPOSE 80

# Start PHP-FPM and Nginx
# Start Nginx service

CMD ["nginx", "-g", "daemon off;"]
RUN ["chmod", "+x", "/var/www/html/entrypoint.sh"]
ENTRYPOINT ["/var/www/html/entrypoint.sh"]

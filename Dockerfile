# Use an official PHP-Apache image
FROM php:8.2-apache

# Install PostgreSQL extension dependencies and enable extensions
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Copy all files into the container
COPY . /var/www/html/

# Give appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite (optional but useful for frameworks like Laravel or clean URLs)
RUN a2enmod rewrite

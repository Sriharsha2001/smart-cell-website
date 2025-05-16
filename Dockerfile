# Use an official PHP-Apache image
FROM php:8.2-apache

# Copy all files into the container
COPY . /var/www/html/

# Give appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite (optional but useful for frameworks like Laravel or clean URLs)
RUN a2enmod rewrite

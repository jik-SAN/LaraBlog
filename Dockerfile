# Use the official PHP image as the base image
FROM php:8.1.17-apache-bullseye

# Copy the application files into the container
COPY . /var/www/html

# Set the working directory in the container
WORKDIR /var/www/html

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libbz2-dev \
    libmcrypt-dev \
    libxslt-dev \
    && docker-php-ext-install \
    bcmath \
    bz2 \
    intl \
    opcache \
    pdo_mysql \
    zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache
RUN npm install && npm run build && npm prune --production

#CMD ["php","artisan","serve","--host=0.0.0.0", "--port=80"]

# Expose port 80
EXPOSE 80

# Define the entry point for the container
CMD ["apache2-foreground"]

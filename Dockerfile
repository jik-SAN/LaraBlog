# Use the official PHP image as the base image
FROM php:8.1.17-apache-bullseye

# Copy the application files into the container
COPY . /var/www/html

RUN apt-get update && apt-get install -y curl
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
RUN apt-get update && apt-get install -y nodejs


# Set the working directory in the container
WORKDIR /var/www/html

# Install necessary PHP extensions
RUN apt-get install -y \
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
    
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

ADD .env.example .env
RUN ls * -lah && chmod -R 777 storage
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev
RUN php artisan key:generate && php artisan config:clear && php artisan route:cache && php artisan view:cache
RUN npm install && npm run build && npm prune --production


# Expose port 80
EXPOSE 80

# Define the entry point for the container
CMD ["apache2-foreground"]

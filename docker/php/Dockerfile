FROM php:8.4-fpm

# Install system dependencies
RUN apt-get clean && apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    exif \
    bcmath \
    gd \
    intl \
    xml \
    zip \
    opcache

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www

# Copy project files
COPY . .

# Composer install
RUN composer install
# RUN composer install --no-dev --optimize-autoloader

# use user www-data
RUN chown -R www-data:www-data /var/www
USER www-data

# В контейнере открываем 9000 порт и запускаем сервер php-fpm
# EXPOSE 9000
CMD ["php-fpm"]

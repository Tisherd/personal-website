FROM php:8.4-fpm

ENV APP_ENV=${APP_ENV:-development}

USER root

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

# Check and install Redis extension only if not already installed
RUN if ! php -m | grep -q redis; then \
        PHP_PEAR_PHP_BIN=php pecl install redis && docker-php-ext-enable redis; \
    fi

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www

# Copy project files
COPY . .

# Composer install
RUN if [ "$APP_ENV" = "production" ]; then \
        composer install --no-dev --optimize-autoloader; \
    else \
        composer install; \
    fi

EXPOSE 9000
# Launch php-fpm
CMD ["php-fpm"]

FROM php:8.4-fpm AS dependency_installer

ENV APP_ENV=${APP_ENV:-development}

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
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    mbstring \
    exif \
    bcmath \
    gd \
    intl \
    xml \
    zip \
    opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Check and install Redis extension only if not already installed
RUN if ! php -m | grep -q redis; then \
    PHP_PEAR_PHP_BIN=php pecl install redis && docker-php-ext-enable redis; \
fi

FROM dependency_installer AS project_installer

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=2.7.0

# Set workdir
WORKDIR /var/www

# Composer install
COPY composer.json composer.lock ./
RUN if [ "$APP_ENV" = "production" ]; then \
        composer install --no-dev --no-scripts --no-progress --prefer-dist --optimize-autoloader; \
        echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    else \
        composer install --no-scripts --no-progress --prefer-dist; \
    fi

# Copy project files
COPY . .

# Switch to correct user based on environment
RUN if [ "$APP_ENV" = "production" ]; then \
        echo "Using www-data user for production"; \
        chown -R www-data:www-data storage bootstrap/cache; \
        export APP_USER=www-data; \
    else \
        echo "Creating devuser with UID 1000 for development"; \
        useradd -ms /bin/bash -u 1000 devuser && \
        chown -R devuser:devuser storage bootstrap/cache; \
        export APP_USER=devuser; \
    fi

# Switch to the correct user
USER $APP_USER

# Launch php-fpm
EXPOSE 9000
CMD ["php-fpm"]

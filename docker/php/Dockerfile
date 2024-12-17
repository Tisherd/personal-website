FROM php:8.4-fpm AS dependency_installer

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

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=2.7.0



FROM dependency_installer AS project_installer

ENV APP_ENV=${APP_ENV:-development}
ARG APP_USER
ENV APP_USER=${APP_USER:-dev_user}

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

# create user if not exist
RUN if ! id -u $APP_USER > /dev/null 2>&1; then \
        useradd -ms /bin/bash -u 1000 $APP_USER; \
    fi

RUN chown -R $APP_USER:$APP_USER storage bootstrap/cache

# Switch to the correct user
USER $APP_USER

# Launch php-fpm
EXPOSE 9000
CMD ["php-fpm"]

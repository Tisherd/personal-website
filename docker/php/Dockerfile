FROM php:8.4-fpm

# Arguments
ARG APP_USER
ARG APP_UID
ARG XDEBUG_ENABLED

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libxml2-dev \
    libzip-dev \
    libssl-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    exif \
    bcmath \
    gd \
    intl \
    xml \
    zip \
    opcache \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Check and install Redis extension only if not already installed
RUN if ! php -m | grep -q redis; then \
        PHP_PEAR_PHP_BIN=php pecl install redis && docker-php-ext-enable redis; \
    fi

# Install Xdebug
RUN if [ "$XDEBUG_ENABLED" = "true" ]; then \
        pecl install xdebug && docker-php-ext-enable xdebug; \
    fi

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=2.7.0

# -------------------------------------

# Set workdir
WORKDIR /var/www

# Copy project files
COPY . .

# create user if not exist
RUN if ! id -u ${APP_USER} > /dev/null 2>&1; then \
        useradd -ms /bin/bash -u ${APP_UID} ${APP_USER}; \
    fi

RUN chown -R ${APP_USER}:${APP_UID} storage bootstrap/cache

# Switch to the correct user
USER ${APP_USER}

# Launch php-fpm
EXPOSE 9000
CMD ["php-fpm"]

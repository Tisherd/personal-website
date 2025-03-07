FROM php:8.4-cli

#Arguments
ARG SUPERVISOR_USER
ARG SUPERVISOR_UID

RUN apt-get update && apt-get install -y \
    supervisor \
    libpq-dev \
    zip unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql bcmath pcntl opcache

# Check and install Redis extension only if not already installed
RUN if ! php -m | grep -q redis; then \
        PHP_PEAR_PHP_BIN=php pecl install redis && docker-php-ext-enable redis; \
    fi

COPY ./docker/supervisor/conf/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/supervisor/conf/laravel-scheduler.conf /etc/supervisor/conf.d/laravel-scheduler.conf

WORKDIR /var/www

COPY . .

RUN useradd -ms /bin/bash -u ${SUPERVISOR_UID} ${SUPERVISOR_USER} || true

RUN chown -R ${SUPERVISOR_USER}:${SUPERVISOR_UID} storage bootstrap/cache

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]

#!/bin/bash

set -e

DOMAIN=${DOCKER_SSL_DOMAIN}
EMAIL=${DOCKER_SSL_EMAIL}
WEBROOT=/var/www/certbot
CERT_DIR=/etc/letsencrypt/live/$DOMAIN

# Проверяем наличие сертификата
if [ ! -d "$CERT_DIR" ]; then
  echo "Сертификаты не найдены. Генерация новых для $DOMAIN..."
  certbot certonly --webroot -w $WEBROOT -d $DOMAIN --email $EMAIL --agree-tos --non-interactive
else
  echo "Сертификаты уже существуют для $DOMAIN."
fi

# Запускаем бесконечный цикл обновления сертификатов
while true; do
  echo "Проверка обновлений сертификатов..."
  certbot renew --webroot -w $WEBROOT
  echo "Ожидание следующей проверки (12 часов)..."
  sleep 12h
done

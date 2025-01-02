#!/bin/bash

# Проверяем, если переменная APP_ENV не равна 'production'
if [ "$APP_ENV" != "production" ]; then
  # Создаем тестовую базу данных
  psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE DATABASE "$POSTGRES_TEST_DB";
EOSQL
else
  echo "APP_ENV is production, skipping test DB creation"
fi

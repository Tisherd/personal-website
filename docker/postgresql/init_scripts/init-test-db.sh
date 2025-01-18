#!/bin/bash

# Check APP_ENV is not equal 'production'
if [ "$APP_ENV" != "production" ]; then
  # Create Test Database
  psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE DATABASE "$POSTGRES_TEST_DB";
EOSQL
else
  echo "APP_ENV is production, skipping test DB creation"
fi

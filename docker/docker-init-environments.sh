#!/bin/bash

# Make sure the script is executed from the correct directory
cd "$(dirname "$0")"

# Clear the ./docker/.env file
> .env

# Array of variables to copy from .env
KEYS_TO_COPY=(
    # base
    "APP_NAME"
    "APP_AUTHOR"
    "APP_ENV"
    ""
    # postgres
    "POSTGRES_DB"
    "POSTGRES_TEST_DB"
    "POSTGRES_USER"
    "POSTGRES_PASSWORD"
    ""
    # mongodb
    "MONGO_INITDB_ROOT_USERNAME"
    "MONGO_INITDB_ROOT_PASSWORD"
    "MONGO_DB_NAME"
    "MONGO_TEST_DB_NAME"
    ""
    # redis
    "REDIS_PASSWORD"
    ""
    # Add other variables if needed
)

# Copy specified variables from .env to ./docker/.env
for key in "${KEYS_TO_COPY[@]}"; do
    if [ -z "$key" ]; then
        # If the key is an empty string, just add a blank line
        echo "" >> .env
    else
        value=$(grep "^$key=" ../.env)
        if [ ! -z "$value" ]; then
            echo "$value" >> .env
        fi
    fi
done

# Copy all remaining lines from ./docker/.env.additional to ./docker/.env
cat .env.additional >> .env

echo "The docker .env file has been updated."

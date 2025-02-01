# Variables
include .env

DOCKER_COMPOSE=docker compose
PHP_CONTAINER=${APP_NAME}_php
NODE_CONTAINER=${APP_NAME}_node
COMPOSER=docker exec ${PHP_CONTAINER} composer
NPM=docker exec ${NODE_CONTAINER} npm

# Commands
.PHONY: build build-no-cache up down restart rebuild logs shell clean \
    composer-install composer-optimize composer-update \
    migrate seed test cache clear-cache \
    npm-install npm-build \
    project-init wait-for-containers wait-for-postgres wait-for-mongo wait-for-redis

# Docker
build:
	${DOCKER_COMPOSE} build

build-no-cache:
	${DOCKER_COMPOSE} build --no-cache

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

restart: down up

rebuild: down build up

logs:
	${DOCKER_COMPOSE} logs -f

shell:
	docker exec -it ${PHP_CONTAINER} bash

clean:
	${DOCKER_COMPOSE} down --volumes --remove-orphans

# Composer
composer-install:
	${COMPOSER} install

composer-optimize:
	${COMPOSER} dump-autoload --optimize

composer-update:
	${COMPOSER} update

# Laravel
migrate:
	docker exec ${PHP_CONTAINER} php artisan migrate

seed:
	docker exec ${PHP_CONTAINER} php artisan db:seed

test:
	docker exec ${PHP_CONTAINER} php artisan test

cache:
	docker exec ${PHP_CONTAINER} php artisan cache
	docker exec ${PHP_CONTAINER} php artisan config
	docker exec ${PHP_CONTAINER} php artisan route
	docker exec ${PHP_CONTAINER} php artisan view

clear-cache:
	docker exec ${PHP_CONTAINER} php artisan cache:clear
	docker exec ${PHP_CONTAINER} php artisan config:clear
	docker exec ${PHP_CONTAINER} php artisan route:clear
	docker exec ${PHP_CONTAINER} php artisan view:clear

# NPM
npm-install:
	${NPM} install

npm-build:
	${NPM} run build

# Project

project-init: clean build up wait-for-containers migrate seed

wait-for-containers: wait-for-postgres wait-for-mongo wait-for-redis

wait-for-postgres:
	@echo "Waiting for database to be ready..."
	@until docker exec ${APP_NAME}_postgres pg_isready -U ${POSTGRES_USER} -d ${POSTGRES_DB}; do \
		echo "Waiting for PostgreSQL..."; \
		sleep 2; \
	done
	@echo "PostgreSQL is ready!"

wait-for-mongo:
	@echo "Waiting for MongoDB to be ready..."
	@until docker exec ${APP_NAME}_mongodb mongo --eval "db.adminCommand('ping')" &>/dev/null; do \
		echo "Waiting for MongoDB..."; \
		sleep 2; \
	done
	@echo "MongoDB is ready!"

wait-for-redis:
	@echo "Waiting for Redis to be ready..."
	@until docker exec ${APP_NAME}_redis redis-cli ping &>/dev/null; do \
		echo "Waiting for Redis..."; \
		sleep 2; \
	done
	@echo "Redis is ready!"

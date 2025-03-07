# Variables
include .env

ENV_TYPE = $(if $(APP_ENV), dev, prod)

DOCKER_COMPOSE=docker compose -f ./docker-compose.${ENV_TYPE}.yml
PHP_CONTAINER=${APP_NAME}_php
NODE_CONTAINER=${APP_NAME}_node
COMPOSER=docker exec ${PHP_CONTAINER} composer
NPM=docker exec ${NODE_CONTAINER} npm

# Commands
.PHONY: docker-build docker-up docker-down docker-restart docker-rebuild \
    docker-logs docker-shell docker-clean docker-volume-prune \
    composer-install composer-install-no-dev composer-optimize composer-update \
    artisan-migrate-refresh artisan-migrate artisan-migrate-force artisan-seed artisan-seed-force \
    artisan-test artisan-cache artisan-clear-cache \
    npm-install npm-build \
    project-init wait-for-containers wait-for-postgres wait-for-mongo wait-for-redis

# Docker
docker-build:
	${DOCKER_COMPOSE} build

docker-up:
	${DOCKER_COMPOSE} up -d

docker-down:
	${DOCKER_COMPOSE} down

docker-restart: docker-down docker-up

docker-rebuild: docker-down docker-build docker-up

docker-logs:
	${DOCKER_COMPOSE} logs -f

docker-shell:
	docker exec -it ${PHP_CONTAINER} bash

docker-clean:
	${DOCKER_COMPOSE} down --volumes --remove-orphans

docker-volume-prune:
	docker volume prune -f

# Composer
composer-install:
	${COMPOSER} install

composer-install-no-dev:
	${COMPOSER} install --no-dev

composer-optimize:
	${COMPOSER} dump-autoload --optimize

composer-update:
	${COMPOSER} update

# Laravel
artisan-migrate-refresh:
	docker exec ${PHP_CONTAINER} php artisan migrate:refresh --seed

artisan-migrate:
	docker exec ${PHP_CONTAINER} php artisan migrate

artisan-migrate-force:
	docker exec ${PHP_CONTAINER} php artisan migrate --force

artisan-seed:
	docker exec ${PHP_CONTAINER} php artisan db:seed

artisan-seed-force:
	docker exec ${PHP_CONTAINER} php artisan db:seed --force

artisan-test:
	docker exec ${PHP_CONTAINER} php artisan test

artisan-cache:
	docker exec ${PHP_CONTAINER} php artisan config:cache
	docker exec ${PHP_CONTAINER} php artisan route:cache
	docker exec ${PHP_CONTAINER} php artisan view:cache

artisan-clear-cache:
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

project-init: docker-clean docker-build docker-up wait-for-containers artisan-migrate-force artisan-seed-force

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
	@until docker exec ${APP_NAME}_mongodb mongosh --eval "db.adminCommand('ping')" &>/dev/null; do \
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

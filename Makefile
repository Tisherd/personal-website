# Variables
APP_NAME=personal_website
DOCKER_COMPOSE=docker compose
PHP_CONTAINER=${APP_NAME}_php
NODE_CONTAINER=${APP_NAME}_node
COMPOSER=docker exec ${PHP_CONTAINER} composer
NPM=docker exec ${NODE_CONTAINER} npm

# Commands
.PHONY: build up down restart rebuild logs shell clean composer npm

# Docker
build:
	${DOCKER_COMPOSE} build

build-no-cache:
	${DOCKER_COMPOSE} build --no-cache

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

restart:
	${DOCKER_COMPOSE} down
	${DOCKER_COMPOSE} up -d

rebuild:
	${DOCKER_COMPOSE} down
	${DOCKER_COMPOSE} build
	${DOCKER_COMPOSE} up -d

logs:
	${DOCKER_COMPOSE} logs -f

shell:
	docker exec -it ${PHP_CONTAINER} bash

clean:
	${DOCKER_COMPOSE} down --volumes --remove-orphans

# Composer
composer-install:
	${COMPOSER} install

composer-update:
	${COMPOSER} update

# Laravel
migrate:
	docker exec -it ${PHP_CONTAINER} php artisan migrate

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

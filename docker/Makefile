# Variables
include .env

DOCKER_COMPOSE=docker compose
PHP_CONTAINER=${APP_NAME}_php
NODE_CONTAINER=${APP_NAME}_node
COMPOSER=docker exec ${PHP_CONTAINER} composer

# Commands
.PHONY: docker-init-environments build build-no-cache up down restart rebuild logs shell clean config

# Docker

docker-init-environments:
	bash ./docker-init-environments.sh

build:
	docker compose build

config:
	${DOCKER_COMPOSE} config

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

generate_ssl:
	${DOCKER_COMPOSE} run --rm certbot certonly --standalone --webroot -w /var/www/docker/nginx/certbot --email ${DOCKER_SSL_EMAIL} -d ${DOCKER_SSL_DOMAIN} --agree-tos --no-eff-email --force-renewal

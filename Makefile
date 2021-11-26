# This is an easily customizable makefile template. The purpose is to
# provide an instant building environment for docker.
#
# Docker:
# ------
# $ make build               - build docker build
# $ make start               - start docker containers
# $ make stop                - stop docker containers
# $ make login               - log in php-fpm APP container

#
# Other:
# ------
# $ make composer-install    - run composer install
# $ make cache-all           - cache:clear + clear-compiled + config:cache


##==========================================================================
## Variables
##==========================================================================
include .env
export
##==========================================================================
DOCKER_EXEC_PHP_FPM = docker exec -it --user=www-data ${CONTAINER_PHP_FPM_NAME}
##====================================docker-compose======================================
DOCKER_COMPOSE_FILENAME = docker-compose.yaml


##==========================================================================
## make build
##==========================================================================
build:
	docker network create ${APP_NETWORK_NAME} || true && \
	docker-compose -f $(DOCKER_COMPOSE_FILENAME) build --no-cache

##==========================================================================
## make start
##==========================================================================
start:
	docker-compose -f $(DOCKER_COMPOSE_FILENAME) up --build -d

##==========================================================================
## make stop
##==========================================================================
stop:
	docker-compose -f ${DOCKER_COMPOSE_FILENAME} down

##==========================================================================
## make login
##==========================================================================
login:
	$(DOCKER_EXEC_PHP_FPM) bash

##==========================================================================
## make remove containers
##==========================================================================
remove:
	docker-compose down --remove-orphans

##==========================================================================
## make composer-install
##==========================================================================
composer-install:
	    $(DOCKER_EXEC_PHP_FPM) composer install

##==========================================================================
## fixer code
##==========================================================================

fixer:
		$(DOCKER_EXEC_PHP_FPM) composer fix

##==========================================================================
## make artisan-command
## make artisan-command CMD=config:cache
##==========================================================================
artisan-command:
    ifneq ($(CMD),)
	    $(DOCKER_EXEC_PHP_FPM) sh -c "php artisan $(CMD)"
    else
	    $(DOCKER_EXEC_PHP_FPM) sh -c "php artisan"
    endif

##==========================================================================
## make cache-all
##==========================================================================
cache-all:
	make artisan-command CMD=cache:clear \
	&& make artisan-command CMD=config:clear \
	&& make artisan-command CMD=clear-compiled \
	&& make artisan-command CMD=config:cache \
	&& make artisan-command CMD=route:cache \
	&& make artisan-command CMD=event:cache


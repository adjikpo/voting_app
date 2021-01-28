
# Date : 25/01/21
# Source author : Cyrille Grandval
# Edited by Arthur Djikpo & Etienne Crespi

CONSOLE=bin/console
DC=docker-compose
HAS_DOCKER:=$(shell command -v $(DC) 2> /dev/null)

ifdef HAS_DOCKER
	ifdef PHP_ENV
		EXECROOT=$(DC) exec -Te PHP_ENV=$(PHP_ENV) php
		EXEC=$(DC) exec -Te PHP_ENV=$(PHP_ENV) php
	else
		EXECROOT=$(DC) exec -T php
		EXEC=$(DC) exec -T php
	endif
else
	EXECROOT=
	EXEC=
endif

.DEFAULT_GOAL := help

.PHONY: help ## Generate list of targets with descriptions
help:
		@grep '##' Makefile \
		| grep -v 'grep\|sed' \
		| sed 's/^\.PHONY: \(.*\) ##[\s|\S]*\(.*\)/\1:\2/' \
		| sed 's/\(^##\)//' \
		| sed 's/\(##\)/\t/' \
		| expand -t14

##
## Project setup & day to day shortcuts
##---------------------------------------------------------------------------
.PHONY: env ## Init
env:
	$(RUN) cp docker-compose.override.yml.dist docker-compose.override.yml
	$(RUN) cp app/.env app/.env.local
	$(RUN) cp .env .env.docker
	echo "Please fill environment files, then use make all"

.PHONY: docker ## Install the project (Install in first place)
docker:
	$(DC) pull || true
	$(DC) --env-file .env.docker build
	$(DC) --env-file .env.docker up -d

.PHONY: composer ## Composer install
composer:
	$(EXEC) composer install

.PHONY: database-init ## Initialization database
database-init:
	$(EXEC) $(CONSOLE) doctrine:database:create --if-not-exists
	$(EXEC) $(CONSOLE) doctrine:schema:update --force

.PHONY: database-reset ## Reset the database
database-reset:
	$(EXEC) $(CONSOLE) doctrine:database:drop --force --if-exists
	make database-init
	make fixtures

.PHONY: all ## Install all the project
all: docker composer database-init

.PHONY: stop ## Stop the project
stop:
	$(DC) down

.PHONY: exec ## Run bash in the php container
exec:
	$(EXEC) /bin/bash

.PHONY: fixtures ## Run the fixtures generator (-q = quiet)
fixtures:
	$(EXEC) $(CONSOLE) hautelook:fixtures:load -q

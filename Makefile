.DEFAULT_GOAL := help

SHELL := /bin/bash
COMPOSE := docker compose -f docker-compose.yml -p hotel
APP := $(COMPOSE) exec -T php-service
NPROC := `nproc`

##@ Setup

.PHONY: cs-fix
cs-fix: ## Auto-fixes any style related code violations
	$(APP) vendor/bin/php-cs-fixer fix src
	$(APP) vendor/bin/php-cs-fixer fix tests

.PHONY: shell
shell: ## Provides shell access to the running PHP container instance
	$(COMPOSE) exec php-service /bin/sh

.PHONY: test-ui
test-ui: ## Provides shell access to the running PHP container instance
	$(APP) bin/phpunit --testsuite=ui

.PHONY: test-unit
test-unit: ## Provides shell access to the running PHP container instance
	$(APP) bin/phpunit --verbose --testsuite=unit
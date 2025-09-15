# Load variables from .env file
ifneq (,$(wildcard ./.env))
    include .env
    export
endif

# Defining variables
COMPOSE = docker-compose
DOCKER = docker
APP_CONTAINER = app-test-task

# Initializing and building the project
init:
	cp .env.example .env || true
	$(COMPOSE) up -d --build

	@echo "⏳ Waiting for MariaDB to start..."
	@sleep 15
	@echo "✅ Database is ready!"

	$(DOCKER) exec -i $(APP_CONTAINER) composer install
	$(DOCKER) exec -i $(APP_CONTAINER) php artisan key:generate
	$(DOCKER) exec -i $(APP_CONTAINER) php artisan migrate
	$(DOCKER) exec -i $(APP_CONTAINER) php artisan db:seed
	$(DOCKER) exec -i $(APP_CONTAINER) php artisan optimize:clear

# Up containers in detached mode
up:
	$(COMPOSE) up -d

# Stopping and removing containers
down:
	$(COMPOSE) down

# Rebuilding containers
rebuild:
	$(COMPOSE) up -d --build

# Accessing the app container
shell:
	$(COMPOSE) exec $(APP_CONTAINER) bash

.PHONY: init down rebuild shell up

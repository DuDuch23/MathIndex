.DEFAULT_GOAL := help

# Dev stack: base + override (bind mounts, exposed ports, Mailpit, node watcher),
# variable substitution from .env.docker (never mixed with the app's own .env).
DC := docker compose --env-file .env.docker
# Prod stack: base + hardening overlay, no dev override. Secrets come from
# .env.prod (real values, created once on the server, never committed — see
# CLAUDE.md). If you deploy via CI/CD instead and export real env vars
# directly, drop --env-file and the flag below is simply unused.
DC_PROD := docker compose --env-file .env.prod -f compose.yaml -f compose.prod.yaml

.PHONY: help install up down dcu build bash logs fixtures migrate migration prod-build prod-up prod-down

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-16s\033[0m %s\n", $$1, $$2}'

install: ## Build images, start the dev stack, run migrations + fixtures
	$(DC) build
	$(DC) up -d
	$(DC) exec app php bin/console doctrine:fixtures:load --no-interaction

up: ## Start the dev stack
	$(DC) up -d

down: ## Stop the dev stack
	$(DC) down

dcu: ## Stop, rebuild and restart the dev stack
	$(DC) down
	$(DC) up -d --build

build: ## Build dev images
	$(DC) build

bash: ## Open a shell in the app (PHP) container
	$(DC) exec app bash

logs: ## Follow logs for every dev service
	$(DC) logs -f

fixtures: ## (Re)load Doctrine fixtures
	$(DC) exec app php bin/console doctrine:fixtures:load --no-interaction

migrate: ## Apply pending Doctrine migrations
	$(DC) exec app php bin/console doctrine:migrations:migrate --no-interaction

migration: ## Generate a new migration from entity changes
	$(DC) exec app php bin/console make:migration

# --- Production -------------------------------------------------------------
# Requires COMPOSE_APP_SECRET, POSTGRES_PASSWORD (and optionally
# COMPOSE_DATABASE_URL to point at an external DB) in .env.prod — compose.yaml
# intentionally has no fallback for these so a missing secret fails loudly
# instead of deploying silently broken/insecure defaults.

prod-build: ## Build production images
	$(DC_PROD) build

prod-up: ## Start the production stack
	$(DC_PROD) up -d

prod-down: ## Stop the production stack
	$(DC_PROD) down

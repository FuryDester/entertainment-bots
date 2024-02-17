.DEFAULT_GOAL := restart

init: docker-down-clear docker-build docker-up copy-env composer-install generate-app-key
up: docker-up
down: docker-down
restart: down up

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans

docker-down-clear:
	docker compose down -v --remove-orphans

docker-build:
	docker compose build

copy-env:
	cp .env.example .env

composer-install:
	docker compose exec hru-check composer install

migrate:
	docker compose exec hru-check php artisan migrate

generate-app-key:
	docker compose exec hru-check php artisan key:generate

shell:
	docker compose exec -it app bash

test:
	docker compose exec app php artisan test

pint:
	docker compose exec app composer pint

pint-fix:
	docker compose exec app composer pint-fix

stan:
	docker compose exec app composer phpstan

lint: pint stan

composer-test:
	docker compose exec app composer test

logs:
	docker compose logs -f

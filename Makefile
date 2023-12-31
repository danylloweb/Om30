API=api_patient

install:
	cd ./Om30/ && cp .env.example .env
	make up
	make compose_install
	make migrate
	docker ps
up:
	docker-compose up -d
	docker ps
	make link
down:
	docker-compose down

bash:
	docker exec -it $(API) bash

build:
	docker-compose build

seed:
	docker exec -t $(API) php artisan db:seed

compose_install:
	docker exec -t $(API) composer install
	docker exec -t $(API) php artisan key:generate

migrate:
	docker exec -t $(API) php artisan migrate
	docker exec -t $(API) php artisan passport:install
	make seed

link:
	 echo Clique aqui para abrir http://localhost

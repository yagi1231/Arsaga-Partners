up:
		docker-compose up -d
down:
		docker-compose down
ps:
		docker-compose ps
bash-app:
		docker-compose exec app bash
bash-web:
		docker-compose exec web bash
bash-db:
		docker-compose exec mysql bash
migrate:
		docker-compose exec app php app/artisan migrat		
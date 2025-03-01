up:
	docker-compose up -d --build

down:
	docker-compose down --volumes

logs:
	docker-compose logs -f

bash:
	docker exec -it php_app bash

test:
	docker exec -it php_app vendor/bin/phpunit

CONTAINER_NAME_PHP=php
CONTAINER_NAME_NODE=node
PHP_CMD=docker exec $(CONTAINER_NAME_PHP)
NODE_CMD=docker exec $(CONTAINER_NAME_NODE)

bash-php:
	docker exec -it $(CONTAINER_NAME_PHP) bash

bash-node:
	docker exec -it $(CONTAINER_NAME_NODE) bash

fixture-load:
	$(PHP_CMD) php bin/console doctrine:fixtures:load  --no-interaction
migration:
	$(PHP_CMD) php bin/console make:migration

migrate:
	$(PHP_CMD) php bin/console doctrine:migrations:migrate
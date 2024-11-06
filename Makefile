SHELL := /bin/bash
EXEC_PHP := docker compose exec -it php
ifeq (locally,$(firstword $(MAKECMDGOALS)))
	EXEC_PHP :=
endif

locally:;@:
.PHONY: locally

##
## Проект
## ------

vendor: composer.json composer.lock ## Собрать vendor
	$(EXEC_PHP) composer install
	$(EXEC_PHP) touch vendor

var:
	mkdir -p var

up: var ## Пересобрать контейнеры
	docker compose up --build --detach --remove-orphans
	$(MAKE) vendor
.PHONY: up

down: ## Удалить контейнеры
	docker compose down --remove-orphans
.PHONY: down

start: var ## Запустить проект
	docker compose start
	$(MAKE) vendor
.PHONY: start

stop: ## Остановить проект
	docker compose stop
.PHONY: stop

php: ## Зайти в контейнер PHP
	$(EXEC_PHP) $(if $(cmd),$(cmd),sh)
.PHONY: php

restart: down up ## Перезапустить приложение
.PHONY: restart

##
## Контроль качества кода
## ----------------------

check: lint psalm rector check-composer ## Запустить все проверки
.PHONY: check

check-composer: composer-validate composer-audit composer-require composer-normalize  ## Запустить все проверки для Composer
.PHONY: check-composer

psalm: var vendor ## Запустить полный статический анализ PHP кода при помощи Psalm (https://psalm.dev/)
	$(EXEC_PHP) vendor-bin/psalm/vendor/bin/psalm --no-diff $(file)
.PHONY: psalm

lint: var vendor ## Проверить PHP code style при помощи PHP CS Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer)
	$(EXEC_PHP) vendor-bin/coding-standart/vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
.PHONY: lint

fixcs: var vendor ## Исправить ошибки PHP code style при помощи PHP CS Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer)
	$(EXEC_PHP) vendor-bin/coding-standart/vendor/bin/php-cs-fixer fix --diff --verbose
.PHONY: fixcs

rector: var vendor ## Запустить полный анализ PHP кода при помощи Rector (https://getrector.org)
	$(EXEC_PHP) vendor-bin/rector/vendor/bin/rector process --dry-run
.PHONY: rector

rector-fix: var vendor ## Запустить исправление PHP кода при помощи Rector (https://getrector.org)
	$(EXEC_PHP) vendor-bin/rector/vendor/bin/rector process
.PHONY: rector-fix

composer-require: vendor ## Обнаружить неявные зависимости от внешних пакетов при помощи ComposerRequireChecker (https://github.com/maglnet/ComposerRequireChecker)
	$(EXEC_PHP) vendor-bin/composer-require-checker/vendor/bin/composer-require-checker check
.PHONY: composer-require

composer-unused: vendor ## Обнаружить неиспользуемые зависимости Composer при помощи composer-unused (https://github.com/icanhazstring/composer-unused)
	$(EXEC_PHP) vendor-bin/composer-unused/vendor/bin/composer-unused
.PHONY: composer-unused

composer-normalize: vendor ## Проверить, что composer.json отнормализован (https://github.com/ergebnis/composer-normalize)
	$(EXEC_PHP) composer normalize --dry-run --diff
.PHONY: composer-normalize

composer-normalize-fix: vendor ## Отнормализовать composer.json (https://github.com/ergebnis/composer-normalize)
	$(EXEC_PHP) composer normalize --diff
.PHONY: composer-normalize-fix

composer-audit: vendor ## Обнаружить уязвимости в зависимостях Composer при помощи composer audit (https://getcomposer.org/doc/03-cli.md#audit)
	$(EXEC_PHP) composer audit
.PHONY: composer-audit

composer-validate: ## Провалидировать composer.json и composer.lock при помощи composer validate (https://getcomposer.org/doc/03-cli.md#validate)
	$(EXEC_PHP) composer validate --strict --no-check-publish
.PHONY: composer-validate

deptrac: var vendor ## Запустить дептрак при помощи deptrac (https://github.com/maglnet/deptrac)
	$(EXEC_PHP) vendor/bin/deptrac analyse --config-file=deptrac.yaml
.PHONY: deptrac

test-unit: var vendor ## Запустить тесты PHPUnit (https://phpunit.de)
	$(EXEC_PHP) vendor/bin/phpunit --exclude-group=integration
.PHONY: test-unit

help:
	@awk ' \
		BEGIN {RS=""; FS="\n"} \
		function printCommand(line) { \
			split(line, command, ":.*?## "); \
        	printf "\033[32m%-28s\033[0m %s\n", command[1], command[2]; \
        } \
		/^[0-9a-zA-Z_-]+: [0-9a-zA-Z_-]+\n[0-9a-zA-Z_-]+: .*?##.*$$/ { \
			split($$1, alias, ": "); \
			sub(alias[2] ":", alias[2] " (" alias[1] "):", $$2); \
			printCommand($$2); \
			next; \
		} \
		$$1 ~ /^[0-9a-zA-Z_-]+: .*?##/ { \
			printCommand($$1); \
			next; \
		} \
		/^##(\n##.*)+$$/ { \
			gsub("## ?", "\033[33m", $$0); \
			print $$0; \
			next; \
		} \
	' $(MAKEFILE_LIST) && printf "\033[0m"
.PHONY: help
.DEFAULT_GOAL := help

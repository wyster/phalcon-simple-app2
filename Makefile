env-file ?= ./.env
container-name = phalcon-simple-app2-php74-phalcon4
port ?= 80

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  setup                    Setup default settings for simple run"
	@echo "  unit-test                Run unit tests"
	@echo "  coverage                 Show code coverage"
	@echo "  run                      Run container"
	@echo "  build                    Build container"
	@echo "  stop                     Stop container"

setup:
	@bash -c "cp -n ./.env.example ./.env"

unit-test:
	[ ! -f $(env-file) ] && echo "Env file not found" && exit 1 || \
	docker run --env-file $(env-file) -it --rm -v `pwd`:`pwd` -w `pwd` $(container-name) /bin/bash -c " \
		docker-php-ext-enable xdebug && \
		rm -f ./data/test.db ./data/clover.xml && \
		php --version && \
		./vendor/bin/phpunit" \

coverage:
	[ ! -f ./data/clover.xml ] && echo "Need run make unit-test before" && exit 1 || \
	docker run -it --rm -v `pwd`:`pwd` -w `pwd` $(container-name) \
		php coverage-checker.php ./data/clover.xml 100

build:
	@docker image build \
		--build-arg PHP_VERSION=7.4-rc \
		--build-arg PHALCON_VERSION=4.0.0-rc.1 \
		-t $(container-name) .

run:
	@docker container run -t --env-file ./.env --publish $(port):80 -v `pwd`:/var/www/html $(container-name)

stop:
	@docker container stop $(docker container ls -q --filter="$(container-name)")



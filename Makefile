help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  unit-test                Run unit tests"
	@echo "  coverage                 Show code coverage"


unit-test:
	@docker run -it --rm -v `pwd`:`pwd` -w `pwd` -v /var/run/docker.sock:/var/run/docker.sock phalcon-simple-app2 \
	docker-php-ext-enable xdebug && \
	rm -f ./data/test.db ./.phalcon/migration-version ./data/clover.xml && \
	./vendor/bin/phalcon migration run --config=./app/config/config.testing.php && \
	./vendor/bin/phpunit \

coverage: unit-test
	@docker run -it --rm -v `pwd`:`pwd` -w `pwd` -v /var/run/docker.sock:/var/run/docker.sock phalcon-simple-app2 \
	php coverage-checker.php ./data/clover.xml 100


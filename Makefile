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
	rm -f ./data/test.db ./data/clover.xml && \
	./vendor/bin/phalcon migration run --log-in-db --config=./app/config/config.testing.php && \
	./vendor/bin/phpunit \

coverage:
	[ ! -f ./data/clover.xml ] && echo "Need run make unit-test before" && exit 1 \
	|| docker run -it --rm -v `pwd`:`pwd` -w `pwd` -v /var/run/docker.sock:/var/run/docker.sock phalcon-simple-app2 \
	php coverage-checker.php ./data/clover.xml 100



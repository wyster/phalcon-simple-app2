help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  unit-test                Run unit tests"
	@echo "  coverage                 Show code coverage"


unit-test:
	@docker run -it --rm -v `pwd`:`pwd` -w `pwd` -v /var/run/docker.sock:/var/run/docker.sock phalcon-simple-app ./vendor/bin/phpunit

coverage: unit-test
	@docker run -it --rm -v `pwd`:`pwd` -w `pwd` -v /var/run/docker.sock:/var/run/docker.sock phalcon-simple-app php coverage-checker.php ./data/clover.xml 100


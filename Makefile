help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  unit-test                Run unit tests"
	@echo "  coverage                 Show code coverage"


unit-test:
	@composer install \
	&& rm -f ./data/test.db ./.phalcon/migration-version \
	&& ./vendor/bin/phalcon migration run --config=./app/config/config.testing.php \
	&& ./vendor/bin/phpunit \
	&& rm -f ./data/test.db ./.phalcon/migration-version \

coverage:
	php coverage-checker.php ./data/clover.xml 100


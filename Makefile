help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  unit-test                Run unit tests"
	@echo "  coverage                 Show code coverage"


unit-test:
	@composer install \
	&& mv ./.phalcon/migration-version ./.phalcon/migration-version-tmp 2>/dev/null \
	&& rm -f ./data/test.db \
	&& ./vendor/bin/phalcon migration run --config=./app/config/config.testing.php \
	&& ./vendor/bin/phpunit \
	&& mv ./.phalcon/migration-version-tmp ./.phalcon/migration-version 2>/dev/null

coverage:
	php coverage-checker.php ./data/clover.xml 100


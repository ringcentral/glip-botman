.PHONY: test
test:
	./vendor/bin/phpunit --coverage-clover build/logs/clover.xml

.PHONY: install
install:
	composer update
	composer install --prefer-dist --no-interaction

.PHONY: coveralls
coveralls:
	./vendor/bin/coveralls -v

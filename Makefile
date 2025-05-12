.PHONY: build

build:
	php vendor/bin/jane-openapi generate --config-file=configuration.php

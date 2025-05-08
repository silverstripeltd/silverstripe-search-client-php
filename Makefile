.PHONY: build

build:
	docker run --rm -v "${PWD}:/local" openapitools/openapi-generator-cli generate \
    -i https://8050-13-54-196-117.ngrok-free.app/api/v1/openapi.json \
    -g php \
    -o /local/ \
    --generate-alias-as-model \
    --additional-properties=srcBasePath=src/Lib,variableNamingConvention=camelCase,invokerPackage=SilverStripe\\Search\\Lib

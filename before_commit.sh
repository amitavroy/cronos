#!/bin/bash

./vendor/bin/pint && \
./node_modules/.bin/prettier -c -w resources/js && \
./vendor/bin/phpstan analyse --memory-limit=2G


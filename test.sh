#!/bin/bash
set -e

php_versions=("php84" "php83" "php82" "php81" "php80" "php74" "php73" "php72" "php71")

for version in "${php_versions[@]}"; do
  docker compose run --rm "${version}composer" composer update --no-cache

  if ! docker compose run --rm "$version" vendor/bin/phpunit; then
    exit 1
  fi
done
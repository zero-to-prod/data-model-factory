#!/bin/bash
set -e

php_versions=("84" "83" "82" "81" "80" "74" "73" "72" "71")

for version in "${php_versions[@]}"; do
  docker compose run --rm php"${version}composer" composer update --no-cache

  if ! docker compose run --rm php"${version}" vendor/bin/phpunit --configuration phpunit"${version}".xml; then
    exit 1
  fi
done
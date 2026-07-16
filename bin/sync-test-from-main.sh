#!/usr/bin/env bash
# Allinea la cartella test a origin/main preservando .env
set -euo pipefail

TEST_DIR="/opt/bitnami/apache/htdocs/test"
cd "$TEST_DIR"

if [[ ! -f .env ]]; then
  echo "ERRORE: manca .env in $TEST_DIR"
  exit 1
fi

cp .env /tmp/vianini-test.env.bak
git fetch origin main
git checkout main
git reset --hard origin/main
git clean -fd
cp /tmp/vianini-test.env.bak .env

php artisan config:clear
php artisan view:clear

echo "OK: test sincronizzato con origin/main @ $(git rev-parse --short HEAD)"
echo "    APP_URL/DB restano quelli di .env (non versionato)"

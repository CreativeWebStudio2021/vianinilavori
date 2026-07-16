#!/usr/bin/env bash
# Allinea la produzione (www) a origin/main
# ATTENZIONE: azzera modifiche locali non committate in website/
set -euo pipefail

PROD_DIR="/opt/bitnami/apache/htdocs/website"
cd "$PROD_DIR"

if [[ ! -f .env ]]; then
  echo "ERRORE: manca .env in $PROD_DIR"
  exit 1
fi

echo "Stato attuale: $(git rev-parse --short HEAD) ($(git status -sb | head -1))"
git fetch origin main

if git status --porcelain | grep -q .; then
  echo ""
  echo "ATTENZIONE: ci sono modifiche locali in website/ che verranno perse:"
  git status --short
  echo ""
  read -r -p "Continuare con reset --hard origin/main? [y/N] " ans
  if [[ "${ans:-}" != "y" && "${ans:-}" != "Y" ]]; then
    echo "Annullato."
    exit 1
  fi
fi

git checkout main
git reset --hard origin/main
composer install --no-dev --optimize-autoloader --no-interaction
php artisan config:clear
php artisan view:clear

echo "OK: produzione aggiornata a origin/main @ $(git rev-parse --short HEAD)"

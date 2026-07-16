#!/usr/bin/env bash
# Da usare in test: commit dei file già in staging + push su main
# Uso:
#   git add <file...>
#   ./bin/push-main-from-test.sh "messaggio del commit"
set -euo pipefail

TEST_DIR="/opt/bitnami/apache/htdocs/test"
cd "$TEST_DIR"

MSG="${1:-}"
if [[ -z "$MSG" ]]; then
  echo "Uso: $0 \"messaggio del commit\""
  echo "Prima: git add dei file da pubblicare"
  exit 1
fi

branch="$(git rev-parse --abbrev-ref HEAD)"
if [[ "$branch" != "main" ]]; then
  echo "ERRORE: sei su '$branch'. Passa a main: git checkout main"
  exit 1
fi

if git diff --cached --quiet; then
  echo "ERRORE: nessuno file in staging. Esegui prima: git add <file...>"
  exit 1
fi

echo "File in commit:"
git diff --cached --name-only
echo ""

git commit -m "$MSG"
git push origin main

echo ""
echo "OK: push su origin/main @ $(git rev-parse --short HEAD)"
echo "Poi aggiorna www con:  /opt/bitnami/apache/htdocs/test/bin/pull-prod.sh"
echo "(oppure attendi il deploy automatico GitHub Actions su push a main)"

#!/usr/bin/env bash
# Verifica HSTS + CSP-RO sui tre hostname Vianini Lavori.
set -euo pipefail

HOSTS=(
  "https://vianinilavori.it"
  "https://www.vianinilavori.it"
  "https://test.vianinilavori.it"
)

NEEDLES=(
  "https://vianinilavori.it"
  "https://www.vianinilavori.it"
  "https://*.elfsightcdn.com"
  "https://*.elfsight.com"
  "wss://*.elfsight.com"
  "https://fonts.googleapis.com"
  "https://fonts.gstatic.com"
)

for h in "${HOSTS[@]}"; do
  echo "=== $h"
  headers=$(curl -sS -o /dev/null -D - "$h" 2>&1)
  echo "$headers" | grep -i -E 'strict-transport|content-security-policy-report-only' || true
  pol=$(echo "$headers" | grep -i 'Content-Security-Policy-Report-Only:' | tr -d '\r' || true)
  if [[ "$h" == *"test.vianinilavori.it"* ]]; then
    if echo "$headers" | grep -qi 'strict-transport'; then
      echo "  FAIL: HSTS presente su test"
    else
      echo "  OK: HSTS assente su test"
    fi
  fi
  if echo "$pol" | grep -qi 'fonts.bunny.net'; then
    echo "  FAIL: fonts.bunny.net ancora in policy"
  else
    echo "  OK: fonts.bunny.net assente"
  fi
  for needle in "${NEEDLES[@]}"; do
    if echo "$pol" | grep -qF "$needle"; then
      echo "  OK: $needle"
    else
      echo "  MISSING: $needle"
    fi
  done
  echo
done

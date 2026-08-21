#!/usr/bin/env bash
#
# Regenerate minified theme assets (*.min.css / *.min.js) from the readable
# source files. The readable files stay the source of truth; production loads
# the .min twins (see inc/enqueue.php -> mcc_asset_min()).
#
# Usage (from anywhere):  bash bin/build-min.sh
# Requires network the first time so npx can fetch terser + clean-css-cli
# (cached afterwards). No node_modules are added to the theme.
#
set -euo pipefail
cd "$(dirname "$0")/.."

CSS_FILES=(
  assets/css/variables
  assets/css/base
  assets/css/layout
  assets/css/components
  assets/css/header
  assets/css/footer
  assets/css/home
  assets/css/service
  assets/css/pages
  assets/css/responsive
)

JS_FILES=(
  assets/js/navigation
  assets/js/components
  assets/js/hero
)

echo "Minifying CSS…"
for f in "${CSS_FILES[@]}"; do
  npx -y clean-css-cli -O2 -o "${f}.min.css" "${f}.css"
  printf '  %-34s %6s -> %6s bytes\n' "${f##*/}.min.css" "$(wc -c < "${f}.css" | tr -d ' ')" "$(wc -c < "${f}.min.css" | tr -d ' ')"
done

echo "Minifying JS…"
for f in "${JS_FILES[@]}"; do
  # Default mangle keeps top-level (global) names intact; only nested locals are
  # renamed, so inline/handler references stay valid.
  npx -y terser "${f}.js" --compress --mangle -o "${f}.min.js"
  printf '  %-34s %6s -> %6s bytes\n' "${f##*/}.min.js" "$(wc -c < "${f}.js" | tr -d ' ')" "$(wc -c < "${f}.min.js" | tr -d ' ')"
done

echo "Done."

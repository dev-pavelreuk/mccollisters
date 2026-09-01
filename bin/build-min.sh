#!/usr/bin/env bash
#
# Regenerate minified theme assets (*.min.css / *.min.js) from the readable
# source files. The readable files stay the source of truth; production loads
# the .min twins (see inc/enqueue.php -> mcc_asset_min()).
#
# CSS uses clean-css level 0 (-O0): it ONLY strips whitespace/comments and never
# reorders, merges, or restructures rules — so the cascade is byte-for-byte
# equivalent and cannot break source-order-dependent styling. (Do NOT use -O2:
# its rule merging/reordering broke this theme.)
#
# Usage (from anywhere):  bash bin/build-min.sh
# Needs network the first time so npx can fetch terser + clean-css-cli (cached
# afterwards). No node_modules are added to the theme.
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
  assets/css/single-post
)

JS_FILES=(
  assets/js/navigation
  assets/js/components
  assets/js/hero
  assets/js/tracking
)

echo "Minifying CSS (clean-css -O0, order-preserving)…"
for f in "${CSS_FILES[@]}"; do
  npx -y clean-css-cli -O0 -o "${f}.min.css" "${f}.css"
  printf '  %-34s %7s -> %7s bytes\n' "${f##*/}.min.css" "$(wc -c < "${f}.css" | tr -d ' ')" "$(wc -c < "${f}.min.css" | tr -d ' ')"
done

echo "Minifying JS (terser)…"
for f in "${JS_FILES[@]}"; do
  # Default mangle keeps top-level (global) names intact; only nested locals are
  # renamed, so inline/handler references stay valid.
  npx -y terser "${f}.js" --compress --mangle -o "${f}.min.js"
  printf '  %-34s %7s -> %7s bytes\n' "${f##*/}.min.js" "$(wc -c < "${f}.js" | tr -d ' ')" "$(wc -c < "${f}.min.js" | tr -d ' ')"
done

echo "Done."

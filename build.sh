#!/usr/bin/env bash
set -euo pipefail

composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
npm_config_cache="${NPM_CONFIG_CACHE:-/tmp/npm-cache}" npm install --no-audit --no-fund
npm run build

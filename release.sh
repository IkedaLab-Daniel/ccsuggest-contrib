#!/bin/bash
set -e

git checkout main
git pull origin main
git fetch fresh-origin
git checkout -B sync-fresh
git reset --soft fresh-origin/main
git add -A
git commit -m "Update public repo to latest stable version"
git push fresh-origin HEAD:main
git checkout main
git branch -D sync-fresh

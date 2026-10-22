#!/bin/bash
set -e

echo "=========================================="
echo " Modern Laravel 13 Blog - VPS Deployment"
echo "=========================================="

# 1. Check for .env file
if [ ! -f .env ]; then
    echo "==> No .env file found. Copying from .env.production.example..."
    cp .env.production.example .env
    echo "==> Please edit .env with your domain / APP_URL and re-run this script."
    exit 1
fi

# 2. Check if APP_KEY is set
if ! grep -q "^APP_KEY=base64:" .env; then
    echo "==> Generating temporary APP_KEY..."
    RANDOM_KEY=$(openssl rand -base64 32)
    sed -i "s|^APP_KEY=.*|APP_KEY=base64:${RANDOM_KEY}|" .env
fi

# 3. Pull latest changes if in git repo
if [ -d .git ]; then
    echo "==> Pulling latest repository changes..."
    git pull origin main || echo "Git pull skipped or failed, continuing with local files..."
fi

# 4. Build and run containers
echo "==> Building and starting production Docker containers..."
docker compose -f docker-compose.prod.yml down --remove-orphans || true
docker compose -f docker-compose.prod.yml build --no-cache
docker compose -f docker-compose.prod.yml up -d

# 5. Check container statuses
echo "==> Checking container health..."
docker compose -f docker-compose.prod.yml ps

echo "=========================================="
echo " Deployment Complete!"
echo " Access your blog at your configured APP_URL"
echo " To view logs: docker compose -f docker-compose.prod.yml logs -f"
echo "=========================================="

# Production VPS Deployment Guide - Modern Laravel 13 Blog

This guide provides complete, production-ready instructions for deploying this modern component-driven **Laravel 13** blog application onto a Virtual Private Server (VPS) using Docker and Docker Compose.

---

## 1. Architecture Overview

```
                                      [ Internet / Client Browser ]
                                                    │
                                     (HTTP Port 80 or Cloudflare Proxy)
                                                    │
                                                    ▼
                       ┌─────────────────────────────────────────────────────────┐
                       │                       Docker Host                       │
                       │                                                         │
                       │   ┌─────────────────────────────────────────────────┐   │
                       │   │           Nginx Container (blog_web_prod)       │   │
                       │   │  - Serves compiled Vite assets (/public/build)  │   │
                       │   │  - Gzip compression & browser cache headers     │   │
                       │   │  - Forwards PHP requests via FastCGI (port 9000)│   │
                       │   └────────────────────────┬────────────────────────┘   │
                       │                            │ FastCGI                    │
                       │                            ▼                            │
                       │   ┌─────────────────────────────────────────────────┐   │
                       │   │         PHP 8.3-FPM Container (blog_app_prod)   │   │
                       │   │  - Laravel 13 framework engine                  │   │
                       │   │  - OPcache bytecode acceleration                │   │
                       │   │  - Auto-migrations & route/view/config caches   │   │
                       │   └──────────────┬──────────────────┬───────────────┘   │
                       │                  │                  │                   │
                       │                  ▼                  ▼                   │
                       │          [ Persistent Volume ] [ Persistent Volume ]    │
                       │            blog_sqlite_data      blog_storage_data      │
                       │         (database/database.db) (uploaded post images)   │
                       └─────────────────────────────────────────────────────────┘
```

---

## 2. Server Prerequisites

A VPS running **Ubuntu 22.04 LTS / 24.04 LTS** or **Debian 12** with at least:
- **1 vCPU** & **1 GB RAM** (2 GB RAM recommended for faster build times)
- **10 GB+ SSD Storage**
- Public IPv4 address

---

## 3. Step-by-Step Deployment Instructions

### Step 1: Connect to Your VPS
SSH into your VPS as root or a sudo user:
```bash
ssh root@your-vps-ip
```

### Step 2: Install Docker & Docker Compose
If Docker is not already installed on your VPS, install the official Docker Engine:
```bash
# Update package repositories
sudo apt-get update
sudo apt-get install -y ca-certificates curl gnupg

# Add Docker official GPG key
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
sudo chmod a+r /etc/apt/keyrings/docker.gpg

# Add Docker repository
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Install Docker Engine and Compose plugin
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Verify installation
docker --version
docker compose version
```

---

### Step 3: Clone or Upload the Application Code
Navigate to your preferred directory (e.g. `/var/www`):
```bash
sudo mkdir -p /var/www
cd /var/www

# Option A: Clone via Git
git clone https://github.com/your-username/your-blog-repo.git blog
cd blog

# Option B: If uploading via SCP/rsync from local machine:
# rsync -avz --exclude='vendor' --exclude='node_modules' --exclude='.git' ./ root@your-vps-ip:/var/www/blog/
```

---

### Step 4: Configure Production Environment Variables
Copy `.env.production.example` to `.env`:
```bash
cp .env.production.example .env
```

Edit `.env` using `nano`:
```bash
nano .env
```

Make sure the following variables are configured:
```ini
APP_NAME="DevSphere Blog"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-server-ip-or-domain.com

# If using port 80 directly on host (standard):
APP_PORT=80

# If using an existing reverse proxy (e.g. Nginx Proxy Manager / Traefik on port 8080):
# APP_PORT=8080
```

---

### Step 5: Build & Launch Production Containers

Run the automated deployment script:
```bash
chmod +x deploy.sh
./deploy.sh
```

Or execute the Docker Compose commands manually:
```bash
# Build production images (compiles Vite CSS/JS and production PHP autoloader)
docker compose -f docker-compose.prod.yml build

# Start services in detached background mode
docker compose -f docker-compose.prod.yml up -d

# Check running containers
docker compose -f docker-compose.prod.yml ps
```

---

### Step 6: Seed Default Data (Optional)
To seed initial blog posts, sample authors, and categories:
```bash
docker compose -f docker-compose.prod.yml exec app php artisan db:seed --force
```

Default credentials seeded:
- **Email**: `alex@example.com`
- **Password**: `password`

---

## 4. Setting up SSL / Domain with Cloudflare (Zero Configuration SSL)

If using Cloudflare:
1. In Cloudflare DNS, add an **A record**:
   - `Type`: `A`
   - `Name`: `@` (or subdomain like `blog`)
   - `IPv4 address`: Your VPS IP
   - `Proxy status`: **Proxied (Orange Cloud)**
2. In Cloudflare **SSL/TLS**:
   - Set encryption mode to **Flexible** or **Full**.
3. In your `.env`:
   - Set `APP_URL=https://yourdomain.com`
4. Re-warm caches:
   ```bash
   docker compose -f docker-compose.prod.yml exec app php artisan config:cache
   ```

---

## 5. Routine Maintenance, Backups & Updates

### How to View Real-Time Logs
```bash
# All logs
docker compose -f docker-compose.prod.yml logs -f

# Web server (Nginx) access & error logs
docker compose -f docker-compose.prod.yml logs -f web

# Application (PHP-FPM / Laravel) logs
docker compose -f docker-compose.prod.yml logs -f app
```

### How to Backup the SQLite Database
Because the database is mounted on a named Docker volume (`blog_sqlite_data`), back it up safely with:
```bash
docker compose -f docker-compose.prod.yml exec app cp /var/www/html/database/database.sqlite /var/www/html/database/backup-$(date +%F).sqlite
```
Or copy it to your host:
```bash
docker cp blog_app_prod:/var/www/html/database/database.sqlite ./database-backup.sqlite
```

### How to Deploy Future Code Updates Manually
Whenever you push changes to your git repository:
```bash
git pull origin main
docker compose -f docker-compose.prod.yml build
docker compose -f docker-compose.prod.yml up -d
```
The entrypoint script will automatically run migrations and re-cache views, routes, and configs without downtime!

---

## 6. Automated Deployment via GitHub Actions (CI/CD)

The repository includes a ready-to-run GitHub Actions workflow [`.github/workflows/deploy.yml`](.github/workflows/deploy.yml).

### How the CI/CD Pipeline Works:
1. **Cloud Build**: When you push to the `main` branch, GitHub Actions builds both the PHP 8.3-FPM (`Dockerfile.prod`) and Nginx (`docker/nginx/Dockerfile`) Docker images in GitHub's cloud runners.
2. **Registry Push**: Images are pushed to **GitHub Container Registry (ghcr.io)** tagged with `latest` and the commit SHA.
3. **SSH Deploy**: GitHub Actions connects to your VPS over SSH, transfers the latest `docker-compose.prod.yml`, pulls the pre-built images from GHCR, and restarts the containers.
4. **Zero VPS CPU Overhead**: Your VPS does not have to compile Vite assets or build PHP extensions, keeping server memory and CPU utilization near zero.

---

### Step 1: Generate an SSH Key Pair for GitHub Actions
On your local computer (or on your VPS), generate a dedicated SSH key pair:
```bash
ssh-keygen -t ed25519 -C "github-actions-deploy" -f ./vps_deploy_key
```
This generates two files:
- `vps_deploy_key` (Private key — keep this secret!)
- `vps_deploy_key.pub` (Public key)

### Step 2: Add Public Key to Your VPS
Copy the content of `vps_deploy_key.pub` and append it to `~/.ssh/authorized_keys` on your VPS:
```bash
# On your VPS:
mkdir -p ~/.ssh
chmod 700 ~/.ssh
nano ~/.ssh/authorized_keys
# Paste the content of vps_deploy_key.pub on a new line and save
chmod 600 ~/.ssh/authorized_keys
```

### Step 3: Add Secrets to GitHub Repository
Go to your GitHub Repository:
1. Click **Settings** > **Secrets and variables** > **Actions**.
2. Click **New repository secret** and add the following:

| Secret Name | Value | Description |
| :--- | :--- | :--- |
| `VPS_HOST` | `123.45.67.89` | Your VPS Public IPv4 Address or domain. |
| `VPS_USERNAME` | `root` (or `ubuntu`) | SSH user on your VPS. |
| `VPS_SSH_KEY` | Content of `vps_deploy_key` | Full private key (including `-----BEGIN OPENSSH PRIVATE KEY-----` and `-----END OPENSSH PRIVATE KEY-----`). |
| `VPS_PORT` | `22` | (Optional) SSH port if not default 22. |
| `GHCR_TOKEN` | `ghp_xxxxxxxxxxxx` | (Optional if private repo) A GitHub Personal Access Token (Classic) with `read:packages` scope so the VPS can pull images. |

> [!TIP]
> **If your GitHub repository is public or you make the GHCR package public:**
> You do NOT even need `GHCR_TOKEN`. The workflow will automatically authenticate using the built-in `GITHUB_TOKEN`.
> To make your package public: Go to GitHub profile > **Packages** > Select `<repo>-app` & `<repo>-web` > **Package settings** > **Change visibility** > **Public**.

---

### Step 4: Initial Setup on VPS
Ensure `/var/www/blog` exists on your VPS with a configured `.env`:
```bash
sudo mkdir -p /var/www/blog
cd /var/www/blog

# Copy the production env template
nano .env
```
Ensure your `.env` contains:
```ini
APP_NAME="DevSphere Blog"
APP_ENV=production
APP_KEY=base64:your_generated_32_byte_key
APP_DEBUG=false
APP_URL=http://your-vps-ip
APP_PORT=80
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
```

---

### Step 5: Trigger Your First Automated Deployment
1. Commit and push your changes to `main`:
   ```bash
   git add .
   git commit -m "feat: setup GitHub Actions CI/CD to VPS"
   git push origin main
   ```
2. Navigate to your GitHub repository > **Actions** tab.
3. Watch the **Build & Deploy to VPS** workflow run in real time!
4. You can also trigger it manually anytime by going to **Actions** > **Build & Deploy to VPS** > **Run workflow**.


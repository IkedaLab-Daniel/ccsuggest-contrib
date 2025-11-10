# Development Guide

Local and Google Cloud Run Deployment

## Table of Contents
- [Quick Start (Using Pre-built Docker Images)](#quick-start-using-pre-built-docker-images)
- [Prerequisites](#prerequisites)
- [Local Development Setup](#local-development-setup)
- [Running with Docker (Recommended)](#running-with-docker-recommended)
- [Running without Docker](#running-without-docker)
- [Publishing Docker Images](#publishing-docker-images)
- [Deployment to Google Cloud Run](#deployment-to-google-cloud-run)
- [Troubleshooting](#troubleshooting)

---

## Quick Start (Using Pre-built Docker Images)

**For developers who just want to run the application without building from source:**

### Prerequisites
- Docker Desktop installed
- MySQL database running (port 3307) with `ccsuggest` database created

### Pull and Run Pre-built Images

1. **Pull the images from Docker Hub**:
```bash
docker pull YOUR_DOCKERHUB_USERNAME/flask-backend:latest
docker pull YOUR_DOCKERHUB_USERNAME/laravel-app:latest
```

2. **Run Flask Backend**:
```bash
docker run -d \
  --name flask-backend \
  -p 5001:8080 \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3307 \
  -e DB_USER=root \
  -e DB_PASSWORD= \
  -e DB_NAME=ccsuggest \
  -e PORT=8080 \
  YOUR_DOCKERHUB_USERNAME/flask-backend:latest
```

3. **Run Laravel Application**:
```bash
docker run -d \
  --name laravel-app \
  -p 8000:8080 \
  -e APP_ENV=local \
  -e APP_KEY="base64:YOUR_APP_KEY_HERE" \
  -e APP_DEBUG=true \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3307 \
  -e DB_DATABASE=ccsuggest \
  -e DB_USERNAME=root \
  -e DB_PASSWORD= \
  -e DTREE_API=http://host.docker.internal:5001 \
  YOUR_DOCKERHUB_USERNAME/laravel-app:latest
```

4. **Access the application**:
   - Laravel: http://localhost:8000
   - Flask API: http://localhost:5001/health

> **Note**: Replace `YOUR_DOCKERHUB_USERNAME` with the actual Docker Hub username where images are published.

---

## Prerequisites

### Required Software
- **macOS/Linux/Windows** with terminal access
- **Docker Desktop** (v20.10+)
- **Git**
- **PHP 8.2+** (for non-Docker setup)
- **Composer** (for non-Docker setup)
- **Python 3.11+** (for non-Docker setup)
- **MySQL 5.7+** or **MariaDB**
- **Node.js 16+** and **npm** (for frontend assets)

### For Google Cloud Run Deployment
- **Google Cloud SDK** (`gcloud` CLI)
- **Google Cloud account** with billing enabled
- **Docker** (to build images)

---

## Local Development Setup

### 1. Clone the Repository
```bash
git clone https://github.com/buzzycode/ccsuggest
cd ccsuggest
```

### 2. Set Up Environment Variables

#### Laravel Backend (.env)
Copy the example and configure:
```bash
cp .env.example .env
```

Update these key values:
```env
APP_NAME="CCSuggest"
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ccsuggest
DB_USERNAME=root
DB_PASSWORD=

# Flask Backend URL (for local Docker) - Ilagay niyo yung actual domain link ng deployed DTREE/Flask
DTREE_API=http://host.docker.internal:5001

# Email Configuration (Brevo SMTP) - Yung sasakin nalang - All goods na setup dito
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=9576f5001@smtp-brevo.com
MAIL_PASSWORD=nV9KItQO8sBHvTD4
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="ccsuggest@gmail.com"
MAIL_FROM_NAME="CCSuggest"
```

Generate application key:
```bash
php artisan key:generate
```

#### Flask Backend (backend/.env)
Create the environment file:
```bash
cd backend
cat > .env << EOF
DB_HOST=127.0.0.1
DB_PORT=3307
DB_USER=root
DB_PASSWORD=
DB_NAME=ccsuggest
PORT=5001
EOF
cd ..
```

### 3. Database Setup (For Local Deployment)

- Go to Phpmyadmin
- Create database "ccsuggest"
- Import SQL file on root directory "ccsuggest.sql"

---

## Running with Docker (Recommended)

### Build Docker Images

#### 1. Build Flask Backend
```bash
cd backend
docker build -t flask-backend .
cd ..
```

#### 2. Build Laravel Application
```bash
docker build -t laravel-app .
```

### Run Containers

#### 1. Run Flask Backend
```bash
docker run -d \
  --name flask-backend \
  -p 5001:8080 \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3306 \
  -e DB_USER=root \
  -e DB_PASSWORD= \
  -e DB_NAME=ccsuggest \
  -e PORT=8080 \
  flask-backend
```

#### 2. Run Laravel Application
```bash
docker run -d \
  --name laravel-app \
  -p 8000:8080 \
  -e APP_ENV=local \
  -e APP_KEY="base64:YOUR_APP_KEY_HERE" \
  -e APP_DEBUG=true \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3306 \
  -e DB_DATABASE=ccsuggest \
  -e DB_USERNAME=root \
  -e DB_PASSWORD= \
  -e DTREE_API=http://host.docker.internal:5001 \
  -e MAIL_HOST=smtp-relay.brevo.com \
  -e MAIL_PORT=587 \
  -e MAIL_USERNAME=your_brevo_email \
  -e MAIL_PASSWORD=your_brevo_smtp_key \
  laravel-app
```

### Access the Application
- **Laravel Frontend**: http://localhost:8000
- **Flask API**: http://localhost:5001
- **Flask Health Check**: http://localhost:5001/health

### Manage Containers
```bash
# View running containers
docker ps

# View logs
docker logs flask-backend
docker logs laravel-app

# Stop containers
docker stop flask-backend laravel-app

# Remove containers
docker rm flask-backend laravel-app

# Restart containers
docker restart flask-backend laravel-app
```

---

## Running without Docker

### Flask Backend

1. **Install Python dependencies**:
```bash
cd backend
python3 -m venv venv
source venv/bin/activate  # On Windows: venv\Scripts\activate
pip install -r requirements.txt
```

2. **Run the Flask server**:
```bash
python run.py
```

The Flask API will be available at http://localhost:5001

### Laravel Application

1. **Install PHP dependencies**:
```bash
composer install
```

2. **Install Node.js dependencies and build assets**:
```bash
npm install
npm run dev  # or npm run build for production
```

3. **Run migrations**:
```bash
php artisan migrate
```

4. **Start the development server**:
```bash
php artisan serve
```

The Laravel application will be available at http://localhost:8000

---

## Publishing Docker Images

**For maintainers: How to share Docker images with other developers**

### Option 1: Docker Hub (Recommended - Free & Easy)

#### Setup
1. **Create a Docker Hub account** at https://hub.docker.com (free)

2. **Login to Docker Hub**:
```bash
docker login
# Enter your Docker Hub username and password
```

#### Push Images

1. **Tag your images with your Docker Hub username**:
```bash
# Tag Flask backend
docker tag flask-backend YOUR_DOCKERHUB_USERNAME/flask-backend:latest
docker tag flask-backend YOUR_DOCKERHUB_USERNAME/flask-backend:v1.0.0

# Tag Laravel app
docker tag laravel-app YOUR_DOCKERHUB_USERNAME/laravel-app:latest
docker tag laravel-app YOUR_DOCKERHUB_USERNAME/laravel-app:v1.0.0
```

2. **Push to Docker Hub**:
```bash
# Push Flask backend
docker push YOUR_DOCKERHUB_USERNAME/flask-backend:latest
docker push YOUR_DOCKERHUB_USERNAME/flask-backend:v1.0.0

# Push Laravel app
docker push YOUR_DOCKERHUB_USERNAME/laravel-app:latest
docker push YOUR_DOCKERHUB_USERNAME/laravel-app:v1.0.0
```

3. **Share the repository links** with your team:
   - `https://hub.docker.com/r/YOUR_DOCKERHUB_USERNAME/flask-backend`
   - `https://hub.docker.com/r/YOUR_DOCKERHUB_USERNAME/laravel-app`

#### For Other Developers
Once published, anyone can pull and run:
```bash
docker pull YOUR_DOCKERHUB_USERNAME/flask-backend:latest
docker pull YOUR_DOCKERHUB_USERNAME/laravel-app:latest
```

### Option 2: GitHub Container Registry (GHCR)

1. **Create a Personal Access Token** on GitHub with `write:packages` permission

2. **Login to GHCR**:
```bash
echo YOUR_GITHUB_TOKEN | docker login ghcr.io -u YOUR_GITHUB_USERNAME --password-stdin
```

3. **Tag and push**:
```bash
# Tag images
docker tag flask-backend ghcr.io/YOUR_GITHUB_USERNAME/flask-backend:latest
docker tag laravel-app ghcr.io/YOUR_GITHUB_USERNAME/laravel-app:latest

# Push images
docker push ghcr.io/YOUR_GITHUB_USERNAME/flask-backend:latest
docker push ghcr.io/YOUR_GITHUB_USERNAME/laravel-app:latest
```

### Option 3: Google Container Registry (GCR)

See the [Deployment to Google Cloud Run](#deployment-to-google-cloud-run) section below.

### Best Practices

1. **Use semantic versioning**: Tag images with version numbers (v1.0.0, v1.1.0, etc.)
2. **Always tag `latest`**: Keep a `latest` tag for the most recent stable build
3. **Add README**: Document environment variables and configuration in your Docker Hub repository
4. **Security**: Don't include secrets in the image - always pass via environment variables
5. **Size matters**: Keep images lean by using `.dockerignore` properly

### Automated Builds (Optional)

You can set up GitHub Actions to automatically build and push images on every commit:

```yaml
# .github/workflows/docker-publish.yml
name: Docker Build and Push

on:
  push:
    branches: [ main ]
    tags: [ 'v*' ]

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      
      - name: Login to Docker Hub
        uses: docker/login-action@v2
        with:
          username: ${{ secrets.DOCKERHUB_USERNAME }}
          password: ${{ secrets.DOCKERHUB_TOKEN }}
      
      - name: Build and push Flask
        uses: docker/build-push-action@v4
        with:
          context: ./backend
          push: true
          tags: |
            YOUR_DOCKERHUB_USERNAME/flask-backend:latest
            YOUR_DOCKERHUB_USERNAME/flask-backend:${{ github.sha }}
      
      - name: Build and push Laravel
        uses: docker/build-push-action@v4
        with:
          context: .
          push: true
          tags: |
            YOUR_DOCKERHUB_USERNAME/laravel-app:latest
            YOUR_DOCKERHUB_USERNAME/laravel-app:${{ github.sha }}
```

---

## Deployment to Google Cloud Run

### Prerequisites
1. **Install Google Cloud SDK**:
```bash
# macOS
brew install google-cloud-sdk

# Or download from: https://cloud.google.com/sdk/docs/install
```

2. **Initialize gcloud**:
```bash
gcloud init
```

3. **Authenticate and set project**:
```bash
gcloud auth login
gcloud config set project YOUR_PROJECT_ID
```

4. **Enable required APIs**:
```bash
gcloud services enable run.googleapis.com
gcloud services enable containerregistry.googleapis.com
```

### Deploy Flask Backend

1. **Configure Docker for GCR**:
```bash
gcloud auth configure-docker
```

2. **Tag and push the image**:
```bash
docker tag flask-backend gcr.io/YOUR_PROJECT_ID/flask-backend:latest
docker push gcr.io/YOUR_PROJECT_ID/flask-backend:latest
```

3. **Deploy to Cloud Run**:
```bash
gcloud run deploy flask-backend \
  --image gcr.io/YOUR_PROJECT_ID/flask-backend:latest \
  --platform managed \
  --region europe-west1 \
  --allow-unauthenticated \
  --set-env-vars DB_HOST=YOUR_CLOUD_SQL_HOST,DB_PORT=3306,DB_USER=root,DB_PASSWORD=YOUR_DB_PASSWORD,DB_NAME=ccsuggest \
  --memory 512Mi \
  --cpu 1
```

4. **Note the Flask service URL** (e.g., `https://flask-backend-xxx.europe-west1.run.app`)

### Deploy Laravel Application

1. **Update environment for production**:
   - Update `DTREE_API` to your Flask Cloud Run URL
   - Set `APP_ENV=production`
   - Set `APP_DEBUG=false`

2. **Tag and push the image**:
```bash
docker tag laravel-app gcr.io/YOUR_PROJECT_ID/laravel-app:latest
docker push gcr.io/YOUR_PROJECT_ID/laravel-app:latest
```

3. **Deploy to Cloud Run**:
```bash
gcloud run deploy laravel-app \
  --image gcr.io/YOUR_PROJECT_ID/laravel-app:latest \
  --platform managed \
  --region europe-west1 \
  --allow-unauthenticated \
  --set-env-vars APP_ENV=production,APP_KEY="base64:YOUR_APP_KEY",APP_DEBUG=false,DB_HOST=YOUR_CLOUD_SQL_HOST,DB_PORT=3306,DB_DATABASE=ccsuggest,DB_USERNAME=root,DB_PASSWORD=YOUR_DB_PASSWORD,DTREE_API=https://flask-backend-xxx.europe-west1.run.app,MAIL_HOST=smtp-relay.brevo.com,MAIL_PORT=587,MAIL_USERNAME=your_brevo_email,MAIL_PASSWORD=your_brevo_smtp_key \
  --memory 1Gi \
  --cpu 1
```

4. **Access your deployed application** at the provided Cloud Run URL

### Setting Up Cloud SQL (Recommended for Production)

1. **Create Cloud SQL instance**:
```bash
gcloud sql instances create ccsuggest-db \
  --database-version=MYSQL_8_0 \
  --tier=db-f1-micro \
  --region=europe-west1
```

2. **Create database**:
```bash
gcloud sql databases create ccsuggest --instance=ccsuggest-db
```

3. **Set root password**:
```bash
gcloud sql users set-password root \
  --host=% \
  --instance=ccsuggest-db \
  --password=YOUR_SECURE_PASSWORD
```

4. **Connect Cloud Run to Cloud SQL**:
Add `--add-cloudsql-instances=YOUR_PROJECT_ID:europe-west1:ccsuggest-db` to your deployment commands.

Update connection string to use Cloud SQL:
```bash
DB_HOST=/cloudsql/YOUR_PROJECT_ID:europe-west1:ccsuggest-db
DB_PORT=3306
```

### Update Deployment with New Environment Variables

To update environment variables without redeploying:
```bash
gcloud run services update flask-backend \
  --region europe-west1 \
  --update-env-vars NEW_VAR=value

gcloud run services update laravel-app \
  --region europe-west1 \
  --update-env-vars NEW_VAR=value
```

---

## Troubleshooting

### Docker Issues

**Problem**: `host.docker.internal` doesn't work
- **Linux**: Use `172.17.0.1` (Docker bridge IP) or `--network host`
- **macOS/Windows**: Should work by default, ensure Docker Desktop is updated

**Problem**: Port already in use
```bash
# Find process using port
lsof -i :8000  # or :5001

# Kill the process
kill -9 PID
```

**Problem**: Container exits immediately
```bash
# Check logs
docker logs flask-backend
docker logs laravel-app
```

### Database Connection Issues

**Problem**: Cannot connect to MySQL
- Ensure MySQL is running: `brew services list` (macOS)
- Check port: Default is 3306, this project uses 3307
- Verify credentials in `.env` files match your MySQL setup
- For Docker: Use `host.docker.internal` instead of `127.0.0.1` or `localhost`

**Problem**: "No rows returned" error in Flask
- Ensure you've run migrations: `php artisan migrate`
- Check if database has data: Run seeders or create test data
- Verify database name matches in both Laravel and Flask `.env` files

### Flask API Issues

**Problem**: Model not trained (503 error)
- Train the model by calling POST `/retrain` endpoint
- Or ensure `model.pkl` exists in the backend directory
- Check that database has responses and recommendations data

**Problem**: CORS errors
- CORS is set to allow all origins with `CORS(app)`
- If still having issues, check browser console for specific error
- Verify Flask is running and accessible

### Laravel Issues

**Problem**: 500 Internal Server Error
- Check Laravel logs: `storage/logs/laravel.log`
- Ensure `APP_KEY` is set: `php artisan key:generate`
- Clear cache: `php artisan cache:clear` and `php artisan config:clear`
- Check file permissions: `chmod -R 775 storage bootstrap/cache`

**Problem**: ERR_SSL_PROTOCOL_ERROR in Docker
- Ensure `APP_ENV=local` for local Docker testing
- For production, set `APP_ENV=production` and ensure proper SSL setup

**Problem**: Images/Assets not loading
- Run `npm run build` to compile assets
- Ensure `public/` directory is properly included in Docker image
- Check `.dockerignore` isn't excluding necessary files

### Google Cloud Run Issues

**Problem**: gcloud command not found
```bash
# Install Google Cloud SDK
brew install google-cloud-sdk

# Or download from cloud.google.com/sdk/docs/install
```

**Problem**: Permission denied pushing to GCR
```bash
gcloud auth configure-docker
gcloud auth login
```

**Problem**: Cloud Run service crashes on startup
- Check logs: `gcloud run logs read --service=SERVICE_NAME --region=europe-west1`
- Verify all required environment variables are set
- Ensure port 8080 is exposed and used (Cloud Run requirement)
- Check memory/CPU limits are sufficient

**Problem**: Database connection fails on Cloud Run
- Use Cloud SQL connection string format
- Enable Cloud SQL Admin API
- Add `--add-cloudsql-instances` flag to deployment
- Use `/cloudsql/PROJECT_ID:REGION:INSTANCE` for DB_HOST

---

## Testing the API

### Health Check
```bash
curl http://localhost:5001/health
```

### Predict Endpoint
See `backend/POSTMAN_EXAMPLE.md` for detailed API examples.

Quick test:
```bash
curl -X POST http://localhost:5001/predict \
  -H "Content-Type: application/json" \
  -d '{
    "features": [3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1,3,4,5,2,1]
  }'
```

### Retrain Model
```bash
curl -X POST http://localhost:5001/retrain
```

---

## Additional Resources

- **Laravel Documentation**: https://laravel.com/docs
- **Flask Documentation**: https://flask.palletsprojects.com/
- **Google Cloud Run Documentation**: https://cloud.google.com/run/docs
- **Docker Documentation**: https://docs.docker.com/

---

## Support

For issues or questions:
1. Check the troubleshooting section above
2. Review application logs
3. Check existing GitHub issues
4. Create a new issue with detailed information

---

**Last Updated**: November 10, 2025

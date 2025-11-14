# Pull the images
docker pull YOUR_DOCKERHUB_USERNAME/flask-backend:latest
docker pull YOUR_DOCKERHUB_USERNAME/laravel-app:latest

# Run Flask backend
docker run -d --name flask-backend -p 5001:8080 \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3307 \
  -e DB_USER=root \
  -e DB_PASSWORD= \
  -e DB_NAME=ccsuggest \
  -e PORT=8080 \
  YOUR_DOCKERHUB_USERNAME/flask-backend:latest

# Run Laravel app
docker run -d --name laravel-app -p 8000:8080 \
  -e APP_ENV=local \
  -e APP_KEY="your-app-key-here" \
  -e DB_HOST=host.docker.internal \
  -e DB_PORT=3307 \
  -e DB_DATABASE=ccsuggest \
  -e DB_USERNAME=root \
  -e DB_PASSWORD= \
  -e DTREE_API=http://host.docker.internal:5001 \
  YOUR_DOCKERHUB_USERNAME/laravel-app:latest
clear
echo "Creating environment"
docker-compose up -d --force-recreate

echo "Installing dependencies"
docker-compose exec app composer install

echo "Application setup complete. Running on http://localhost"

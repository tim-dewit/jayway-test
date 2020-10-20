Clear-Host
Write-Host "Creating environment"
docker-compose up -d --force-recreate

Write-Host "Installing dependencies"
docker-compose exec app composer install

Write-Host "Application setup complete. Running on http://localhost"

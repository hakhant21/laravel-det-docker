# Documentation For Laravel Docker Project 

 - NGINX
 - MYSQL
 - PHP
 - REDIS
 - MQTT
 - NPM

This project sets up multiple services using Docker, including Nginx, PHP, Composer, Mosquitto (with WebSocket support), and MySQL. It uses a `docker-compose.yml` file to manage the services together and configure them efficiently. Below you will find a breakdown of the project structure, configuration files, and setup instructions.

## Laravel Docker Development Setup

### Prerequisites
- Docker
- Docker Compose

### Installation Steps

1. Clone the repository
```bash
git clone https://github.com/hakhant21/laravel-det-docker.git

# first copy .env.example to .env for mysql
cp .env.example .env

# for docker 
MYSQL_DATABASE=fuel_pos
MYSQL_HOST=mysql
MYSQL_PORT=3306
MYSQL_USER=detpos
MYSQL_PASSWORD=asdffdsa
MYSQL_ROOT_PASSWORD=asdffdsa

# then go to src and update .env file like what you create above .env for laravel
cp .env.example .env
# laravel .env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=fuel_pos
DB_USERNAME=detpos
DB_PASSWORD=asdffdsa

# go to src and run
composer install

# generate key
php artisan key:generate

# real time reverb install 
php artisan reverb:install 
```

## Build and Start the Containers

```bash
docker-compose up -d --build

# composer service
docker-compose run --rm composer

# artisan service
docker-compose exec app php artisan

# npm service
docker-compose exec app npm install / run dev / run build 

# running inside container 
docker-compose exec app sh

# shutting down container
docker-compose down
```

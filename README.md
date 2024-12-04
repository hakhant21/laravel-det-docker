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

```

2. Navigate to the project directory
```bash
cd path/to/laravel-det-docker

# build and run the container for development
docker-compose up -d --build

# build and run the container for production
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build

# go into container 
docker-compose exec app sh

# install composer
composer install

# npm install and build
npm install && npm run build

# key generate
php artisan key:generate

# migrate database
php artisan migrate

# link storage
php artisan storage:link

# give permission to storage
chmod -R 777 storage

# shutting down container
docker-compose down
```

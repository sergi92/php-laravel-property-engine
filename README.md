# php-laravel-property-engine
`#laravel` `#docker` `#api REST`


<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0-blue.svg?cacheSeconds=2592000" />
</p>

> In this project we will build an API for a properties platform, which will have Users, Properties, and Favourites.
>

## Index <!-- omit in toc -->

- [Requirements](#requirements)
- [Repository](#repository)
- [Project delivery](#project-delivery)
- [Resources](#resources)

## Requirements

**Tools we are going to use:**

- Postman (is a free and open-source API testing software)
- Docker (open platform for developing, shipping, and running applications)
- PHP 8.0 (application code)
- MySQL 5.7 (database)
- NGINX (webserver)
- phpMyAdmin (database managment)
- Redis (caching)
- MailHog (local mail testing)


## Repository

First of all you must fork this project into your GitHub account.

To create a fork on GitHub is as easy as clicking the “fork” button on the repository page.

<img src="https://docs.github.com/assets/images/help/repository/fork_button.jpg" alt="Fork on GitHub" width='450'>

### Step 1: Clone Laravel’s git repository

We will run a Laravel 8 application in a custom container that will communicate with other containers (database, cache, etc) the build a complete development environment.

```
git clone https://github.com/laravel/laravel.git src
```

### Step 2: Create a custom PHP 8 image

```
$ docker run php:8.0.3-fpm-buster php -m
```

### Step 3: Setup the basic services (PHP, NGINX and MySQL)
The first version of our docker-compose.yaml file will look like this
```
version: "3.7"
networks:
    app-network:
        driver: bridge

services:
    app:
        build: 
            context: ./
            dockerfile: Dockerfile
        image: laravel8-php-fpm-80
        container_name: app
        restart: unless-stopped
        tty: true
        working_dir: /var/www
        volumes: 
            - ./src:/var/www
        networks: 
            - app-network
    
    mysql:
        image: mysql:5.7.33
        container_name: mysql
        restart: unless-stopped
        tty: true
        environment: 
            MYSQL_DATABASE: laravel8
            MYSQL_ROOT_PASSWORD: 123456
            MYSQL_PASSWORD: 123456
            MYSQL_USER: laravel8
            SERVICE_TAGS: dev
            SERVICE_NAME: mysql
        volumes: 
            - ./mysql/data:/var/lib/mysql
        networks:
            - app-network
    
    nginx:
        image: nginx:1.19.8-alpine
        container_name: nginx
        restart: unless-stopped
        tty: true
        ports: 
            - 8100:80
        volumes: 
            - ./src:/var/www
            - ./nginx/conf:/etc/nginx/conf.d
        networks: 
            - app-network


```
### Step 4: Test our initial setup

```
docker-compose up
docker-compose exec -T app composer install
docker-compose exec -T app cp .env.example .env
docker-compose exec -T app php artisan key:generate
docker-compose exec -T app php artisan config:clear
docker-compose exec -T app php artisan migrate
docker-compose exec -T app composer require laravel/socialite
```
### Step 5: Setup additional services (Redis, phpMyAdmin and MailHog) OPTIONAL

```
$ docker run php:8.0.3-fpm-buster php -m
```
### Step 6: Install Laravel Sanctum Pacakage

```
composer require laravel/sanctum
docker-compose exec -T app php artisan vendor:publish--provider="Laravel\Sanctum\SanctumServiceProvider"
docker-compose exec -T app php artisan migrate
docker-compose exec -T app php artisan make:migration create_properties_table
```
### Step 7: Create REST API Routes
You need to use controllers to build sanctum auth api routes; we have defined the login, register post methods and resources to create auth api collectively.
```
<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
  
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
     
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('blogs', BlogController::class);
});
```
### Step 8: Test Sanctum REST API in Postman
We have created the REST API using sanctum auth; further you need to start the laravel development server with the help of the php artisan command:
```
docker-compose exec -T app php artisan serve
```


## Project delivery

To deliver this project you must follow the steps indicated in the document:

- [Submitting a solution](https://www.notion.so/Submitting-a-solution-524dab1a71dd4b96903f26385e24cdb6)

## Resources

**Here are some examples of resources:**

- [POSTMAN](https://www.postman.com/)
- [DOCKER](https://www.docker.com/products/docker-desktop)
- [LARAVEL](https://laravel.com/docs/8.x/deployment#server-requirements)

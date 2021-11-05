# SunMoonTech Backend API

[Laravel  REST API using Passport Authentication ](https://github.com/deepfaith/sunmoontech-exam)

The architecture follows a modular design for scalability and managing large scale apps.

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/deepfaith/sunmoontech-exam.git

Switch to the repo folder

    cd sunmoontech-exam-master

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Configure Database (**Set the database variables in .env**)

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE={{database}}
    DB_USERNAME={{user}}
    DB_PASSWORD={{password}}


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Install Laravel Passport

    php artisan passport:install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## Seeders
Create a seed script to prepopulate the data. Database should have at least 1 user, 2 posts and 2 comments per post.

Create a default user if you're going to use the postman collection
    
    php artisan module:seed User

Create 1 user, 2 posts and 2 comments per posts

    php artisan module:seed Blog

**TL;DR command list**

    git clone https://github.com/deepfaith/sunmoontech-exam.git
    cd sunmoontech-exam-master
    composer install
    cp .env.example .env
    php artisan key:generate

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan passport:install
    php artisan serve

    php artisan module:seed User
    php artisan module:seed Blog

The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

## API Specification


> [Full API Spec](https://github.com/deepfaith/sunmoontech-exam/tree/master/Modules)

----------

## Dependencies

- [fideloper/proxy](https://github.com/fideloper/TrustedProxy) - Set trusted proxies for Laravel
- [laravel-cors](https://github.com/barryvdh/laravel-cors) - For handling Cross-Origin Resource Sharing (CORS)
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) - Guzzle is a PHP HTTP client library
- [laravel/passport](https://github.com/laravel/passport) - Laravel Passport provides OAuth2 server support to Laravel.
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) - Guzzle, PHP HTTP client
- [laravel/passport](https://github.com/laravel/passport) - Laravel Passport is an OAuth2 server and API authentication package that is simple and enjoyable to use.
- [nwidart/laravel-modules](https://github.com/nWidart/laravel-modules) -  Laravel package which created to manage your large Laravel app.

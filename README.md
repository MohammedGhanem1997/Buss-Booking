
Online Bus Booking System  
# Requirements
- Stable version of [Docker](https://docs.docker.com/engine/install/)
- Compatible version of [Docker Compose](https://docs.docker.com/compose/install/#install-compose)
- php 8.1
- mysql

# How To Run Project
-   `composer install`,
-   `composer dump-autoload`,
-   ` repelace.env.example' to '.env';`
-  `php artisan key:generate`,
-  `php artisan config:cache`,
-   `php artisan migrate --seed`
- `php artisan passport:install`
- add `PASSPORT_PERSONAL_ACCESS_CLIENT_ID `
  `PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET` in .env
# Run Unit Test

- `composer test` or `vendor/bin/phpunit`


# How to work 
BUS booking CONSISTS OF MAINLY Two MODULES. THEY ARE

            ADMIN MODULE
            AGENT MODULE
            USER MODULE

ADMIN MODULE

Admin has overall control of the system. The main functions of admin are given below.

Bus Management

Trip Management 

Add Agent

View Booking Details and confirm the online booking and add offline booking 

AGENT MODULE

The Agent Module also consists of same functions as admin module.

USER MODULE

    Can register or login
    Book bus.
    View and select(search) the trip

    Booking by selecting trip, date of journey and the return date
    View available buses


---------------------------------------------------------------------------------

# PostMan Collection For Integration by mobile or web 

<a href="./booking.postman_collection.json"> postman collection <a/>

# How To Deploy (Docker)

### For first time only !
- `sudo docker-compose up -d --build`
- `docker-compose exec composer setup`
- `docker-compose exec php artisan passport:install`


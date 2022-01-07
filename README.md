# reservation-stores

## Overview

A web application that allows you to manage reservations for multiple stores using Laravel.

## Description

It is possible to accept reservations from users.  
Reservation slots can be narrowed down by date and plan.  
Credit card payment is possible at the time of reservation.  
You can register multiple stores.

## Demo

<!-- ## VS. -->

## Requirement

-   "laravel/framework": "^8.40"

## Usage

Admin login page 　(test acount => emal: admin@ne.jp / pass: admin123)  
[http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

User reservation page  
[127.0.0.1:8000](127.0.0.1:8000)

## Install

1. Get source code

    ```
    git clone git@github.com:t-aono/reservation-stores.git
    ```

2. Copy .env-example to create .env.

    ```
    cp .env-example .env
    ```

3. Create database/database.sqlite and prepare the database.

    ```
    touch database/database.sqlite
    ```

4. Add package.

    ```
    omposer install
    ```

5. Start local development environment.

    ```
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    php artisan serve
    ```

<!-- ## Contribution -->

<!-- ## Licence -->

## Author

[t-aono](https://github.com/t-aono)

<!-- README.md Sample -->
<!-- https://deeeet.com/writing/2014/07/31/readme/ -->

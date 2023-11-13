# Pasafund exam

## Requirements:
Node version 18 >
MySQL > 8

## Installation
1. Clone repository
2. `composer install`
3. `php artisan install`
4. `npm run install`

## Mock data
1. Make sure you have database name "pasafund"
2. `php artisan migrate:fresh`
3. `php artisan db:seed`

## Access the local site
1. `php artisan serve`
2. Open new terminal `npm run dev`
3. Copy this url localhost:8000 and paste to the browser
4. Login using this user data
    email: test@example.com
    password: password
5. Home site localhost:8000/posts/all

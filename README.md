## About Project

With this project you can get the historical quotes for companies. Initially, 
you need to fill in the main form with the company symbol (i.e AAIT), the start 
and end date. Finally, you need to add your email address to get an email with 
search details (company name, start and end date).

## How to use
Initially, you need to install it:
- You need to have installed "docker compose" on your machine. If not, please, read
this **["Install docker compose"](https://docs.docker.com/compose/install/)**. 

- Go to the root folder of project, and in command line do:
```
docker compose build
docker compose up
```
- Inside command line of "php-apache" container (docker exec -it php-apache /bin/sh) do:
```
cd /var/www/html/public
composer install
php artisan key:generate
php artisan migrate:refresh --seed
```
- In your browser, type:
```
http://localhost:8000/
```
If you want to see the database, then in your browser type:
```
http://localhost:8080/
```
- user: kostas
- password: This_is_1!

## How to run tests
Inside command line of "php-apache" container (docker exec -it php-apache /bin/sh).
In the root folder of project do:
```
vendor/bin/phpunit tests
```


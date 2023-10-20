# Order service

This is an app for managing some order functionality. It can

* create and order
* change status of an order
* list orders, filter by:
    * order ID
    * status
    * order created after a time
    * order created before a time

The app is written with Laravel 10, standard MVC used for the solution.
You can find the entry points in [`api.php`](routes/api.php) file which leads to [`Controllers`](app/Http/Controllers) directory.  
The controllers are using the Order and OrderProduct model, to store and load data from the database.

For order list filtering there is a [`ListOrdersQueryBuilder`](app/Models/ListOrdersQueryBuilder.php) class to make the right query.

For more detailed info and specs, check the [AsciiDoc](docs/index.adoc) file. _To view it, you may open it in PHPStorm or VSCode with AsciiDoc plugin installed_

## Run the app

### Development environment

#### Requirements

* composer
* PHP 8.2
* docker

#### setup

First install dependencies

```shell
composer install
```

Then you need to copy .env.example to .env file, then generate a laravel key.

```shell
php artisan key:generate
```

Then start the app with docker

```shell
docker compose up -d
```

_Maybe you need to change the port, if your port 80 is bus. You can do it by adding an APP_PORT= row in the .env file._

Then you need to create the database:

Enter the app's docker container

```shell
docker compose exec -ti laravel.test bash
```

Create the database:

```shell
php artisan migrate
```
_choose yes when asking for database creation_

You can seed some data to the database

```shell
php artisan db:seed
```

#### How to try the app

You can find a [`debug.http`](debug.http) REST client file with some example requests. Feel free to try with VSCode or PHPStorm.

Also you can run laravel commands to make requests:

```shell
php artisan app:change-order-status <orderId> <status>
php artisan app:create-order <requestBodyInJson>
php artisan app:list-orders [--orderId=] [--status=] [createdAfter=] [createdBefore=]
```

#### Run tests

If your local environment is working, you can run tests (inside from the docker container):

```shell
./vendor/bin/phpunit
```
_(Now the test env using the same database, so after running test, your previous data will be purged)_

#### Open API

Check the swagger docs at the [link](http://localhost/api/doc)

[![PyPI license](https://img.shields.io/pypi/l/ansicolortags.svg)](https://pypi.python.org/pypi/ansicolortags/)     [![GitHub followers](https://img.shields.io/github/followers/b0nbon1.svg?style=social&label=Follow&maxAge=2592000)](https://github.com/b0nbon1?tab=followers)


# dA Restaurant

![welcome image](https://i.ytimg.com/vi/MHG3n_-Y33A/maxresdefault.jpg)

## About dA Restaurant 

dA Restaurant  is a complete food ordering laravel for presenting a restaurant menu and accepting orders on the go. It comes with a powerful Self Hosted Administration Panel, where restaurant owners can create/update their menu and prices, their business information and manage their order. 

``
I did this project for learning purposes so please raise issues and pull request for more modifications, errors or to improve the api. ``

# Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. Documentation coming soon for deployment and production purposes

## Prerequisites
* [php](http://php.net/)
* [composer](https://getcomposer.org/)

## Installing

Install laravel framework

```sh
composer global require "laravel/installer"
```

Naviage to `/api` folder

Create a database then rename `.env.example` to `.env` add database variables

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=root
DB_USERNAME=db
DB_PASSWORD=*******
```

Install the required packages and run the local server

```sh
composer install
```

Generate database tables and relations

```sh
php artisan migrate
```

Create `img` folder inside `storage/app/public` and run

```sh
php artisan storage:link
```

Create client for passport auth
```sh
 php artisan passport:client --personal
 ```

Run the localhost

```sh
php artisan serve
```


## License

The dA Restaurant api is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author By

Built by [Bonvic Bundi](https://github.com/b0nbon1) 

[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](https://twitter.com/Bonvic7) [![GitHub followers](https://img.shields.io/github/followers/b0nbon1.svg?style=social&label=Follow&maxAge=2592000)](https://github.com/b0nbon1?tab=followers)

# MoWlkky

[![Build Status](https://travis-ci.org/Wanimo/MoWlkky.svg?branch=master)](https://travis-ci.org/Wanimo/MoWlkky)

Create and organize Molkky game tournaments with MoWlkky.

## Status

It's just the beginning, we'll work on this project very soon, be patient :)
Ideas and feedback are welcomed.

## Installation

Clone the repository first :

```
git clone https://github.com/Wanimo/MoWlkky.git
```

Copy the ``/.env.dist`` file and create a ``/.env`` file with database parameters.

Then build and start Docker to have an operational dev environment :

```
docker-compose build
docker-compose up
```

Now, get all the vendors libraries with the integrated composer container :

```
docker-compose run composer install
```

If there is a **file permission issue** on the `cache:clear` operation, you may have to remove your `var/cache` and `var/logs` directories :

```
rm -rf var/cache
rm -rf var/logs
```

And let Symfony create it for you with the right permissions via an HTTP request : [your home page](http://127.0.0.1:8080/app_dev.php) .

You must now install the front end vendors libraries with Bower :

```
docker-compose run front-tools bower install
```

Install NPM and launch Grunt for assets management :

```
docker-compose run front-tools npm install
docker-compose run front-tools grunt
```


Create database with this command :

```
docker-compose run engine bin/console --env=dev doctrine:schema:create
```

That's it ! You're ready to [go](http://127.0.0.1:8080/app_dev.php) ! :)

## Initialization

Now the project is installed, you should create your first user before doing anything else.
There is a Symfony command for that :

```
docker-compose run engine bin/console --env=dev mowlkky:user:create
```

## Tests

### Unit

MoWlkky uses PHPUnit for unit testing.
You can launch the tests with this command :

```
docker-compose run engine phpunit
```

### Functional

For functional testing, Behat is used.
Run it with this command :

```
docker-compose run engine behat
```

## Let's play !

```
  ( 7)( 9)( 8)
( 5)(11)(12)( 6)
  ( 3)(10)( 4)
    ( 1)( 2)
```

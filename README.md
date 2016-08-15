# MoWlkky

Create and organize Molkky game tournaments with MoWlkky.

## Status

It's just the beginning, we'll work on this project very soon, be patient :)
Ideas and feedback are welcomed.

## Installation

Clone the repository first :

```
git clone https://github.com/Wanimo/MoWlkky.git
```

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

And let Symfony create it for you with the right permissions via an HTTP request : [your home page](127.0.0.1:8080) .

You must now install the front end vendors libraries with Bower :

```
docker-compose run front-tools bower install
```

Install NPM and launch Grunt for assets management :

```
docker-compose run front-tools npm install
docker-compose run front-tools grunt
```

That's it ! You're ready to go ! :)

## Unit testing

MoWlkky uses PHPUnit for unit testing.
You can launch the tests with this command :

```
docker-compose run engine phpunit
```


```
  ( 7)( 9)( 8)
( 5)(11)(12)( 6)
  ( 3)(10)( 4)
    ( 1)( 2)
```

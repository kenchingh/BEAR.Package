BEAR.Package
=============================

 * master  [![Latest Stable Version](https://poser.pugx.org/bear/package/v/stable.png)](https://packagist.org/packages/bear/package)[![Build Status](https://secure.travis-ci.org/koriym/BEAR.Package.png?branch=master)] (http://travis-ci.org/koriym/BEAR.Package)
 * develop [![Latest Unstable Version](https://poser.pugx.org/bear/package/v/unstable.png)](https://packagist.org/packages/bear/package)[![Build Status](https://secure.travis-ci.org/koriym/BEAR.Package.png?branch=develop)](http://travis-ci.org/koriym/BEAR.Package)

Introduction
------------
BEAR.Package is a [BEAR.Sunday](https://github.com/koriym/BEAR.Sunday) resource oriented framework package.

Installation
------------

    $ curl -s http://install.bear-project.net/ | sh -s ./bear

or

    $ php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
    $ php composer.phar create-project --dev --prefer-source bear/package ./bear

More information is availavle at [wiki:install](http://code.google.com/p/bearsunday/wiki/install).

built-in web server for development
------------------

    $ cd bear/apps/Sandbox/public
    $ php -S localhost:8088 web.php
    $ php -S localhost:8089 api.php

Virtual Host for Production
------------
Set up a virtual host to point to the public/ directory of the application.

Console
-------

    $ php web.php get /index
    $ php api.php get page://self/index
    $ php api.php get 'app://self/first/greeting?name=World'
    $ php api.php get app://self/blog/posts

Make your own application
----------------------------------

### install

    $ php bin/new_app.php MyApp

### test

    $ cd apps/MyApp
    $ phpunit

### run

    $ cd public
    // Console
    $ php web.php get /
    // Web
    $ php -S localhost:8090 web.php

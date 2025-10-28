### Symfony & PHP Mastery : Build a Social Web App

# Udemy source

> https://www.udemy.com/course/symfony-framework-hands-on/learn/lecture/33253600#questions/18701102

# Start server Command

> symfony server:start

# New controller

> /src/Constroller/HelloController.php

# New Route

> /config/routes.yaml

# Find current routes

> symfony console debug:router

### Twig templates

> composer require twig

> HelloControler.php -> class HelloController extends AbstractController

> HelloController.php -> return $this->render('hello/index.html.twig', function);

> /temlates/hello/index.html.twig -> <i>{{ message }}</i>

## Twig template inheritance

> show_one.html.twig -> {% extends 'base.html.twig' %}
> show_one.html.twig -> {% block body %} X {% endblock%}

### TWIG Templates

> https://twig.symfony.com/

## Partial template

> /templates/hello/\_message.html.twig

### Links

# Get paths names

> symfony console debug:router

# path Twig function

> index.html.twig -> <a href="{{ path('app_show_one', {id: key}) }}">

### Symfony Maker Bundle

> composer require --dev symfony/maker-bundle

# List make commands

> symfony console list make

> symfony console make:controller

### Symfony Profiler

> https://symfony.com/doc/current/profiler.html

> composer require --dev symfony/profiler-pack

### Database

> composer require symfony/orm-pack

# Database file

> localhost/phpmyadmin, .env
> /config/packages/doctrine.yaml - server version

# Verify connection to DBB

> symfony console list doctrine

# Create DBB with name from .env

> symfony console doctrine:database:create

### Create entity

> symfony console make:entity

> symfony console make:migration
> symfony console doctrine:migration:status
> symfony console doctrine:migration:migrate

# Back database migration

> symfony console doctrine:migration:migrate --help
> symfony console doctrine:migration:migrate prev

# Run migration without questions

> symfony console doctrine:migration:migrate --no-interaction

### Fake Data (Doctrine Fixtures Bundle)

> composer require --dev orm-fixtures

# New File

> /src/DataFixtures/AppFixtures.php

# Write fake data - DoctrineFixtureBundle

> symfony console doctrine:fixtures:load

# Version 6.3+ of Symfony

> https://symfony.com/doc/current/doctrine.html#persisting-objects-to-the-database

### Depedency Injection

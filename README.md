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

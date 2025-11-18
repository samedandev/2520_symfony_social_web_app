### Symfony & PHP Mastery : Build a Social Web App

# Udemy source

> https://www.udemy.com/course/symfony-framework-hands-on/learn/lecture/33253600#questions/18701102

# This git

> https://github.com/samedandev/2520_symfony_social_web_app

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

### Param Converter

> composer require sensio/framework-extra-bundle

### Symfony FORMS

> https://symfony.com/doc/current/forms.html
> composer require symfony/form

# Abstract

> $this = abstract Controller

# Success message

> base.html.twig

> ![Form](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/01.jpg)

# Form Themes

> https://symfony.com/doc/current/form/bootstrap5.html
> https://symfony.com/doc/current/form/form_themes.html

> /config/paackages/twig.yaml -> form_themes: ['bootstrap_5_layout.html.twig']

### Create forms automatically

> symfony console make:form

# New file created

> src/Form/MicroPostType.php

### Tailwind integration

> https://tailwindcss.com/docs/dark-mode

# Dark mode

> ![Dark Mode](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/02.jpg)

### Create Form Theme

# New theme

> /tempates/form/fields.html.twig

# Use Theme

> /config/packages/twig.yaml

# Validator

> composer require symfony/validator

> /config/packages/framework.yaml -> form: legacy_error_messages: false

# Add to the template

> /templates/micro_post/\_form.html.twig ->

### Disable HTML5 form validation

> \_form.html.twig -> {{ form_start(form, {'attr': {'novalidate': 'novalidate'}}) }}

# Check form is valid in Controller

> MicroPostController.php -> $form->isValid()
> /entity/MicroPost.php -> #[Assert\NotBlank()]
> ![Validator in Controller](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/03.jpg)

### USER One To One relation

> symfony console make:user

# Add several properties

> symfony console make:migration

> symfony.exe console doctrine:migrations:migrate

### Add One TO One relationship between User & UserProfile

> ![OneToOne](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/04.jpg)

# Apply to Database

> symfony console make:migration

# Cascade User + UserProfile relationship

> UserProfile.php -> #[ORM\OneToOne(inversedBy: 'userProfile', cascade: ['persist', 'remove'])]

### One To Many Relation

> symfony console make:entity -> Entity/Comment.php + Repository/CommentRepository.php

# Update MicroPost

> symfony console make:entity -> MicroPost (edit) -> New Property Name (comments) -> Field Type (OneToMany)

# What class should this entity () be related to?

> Comment -> A new property will also be added to the Comment class so that you can access and set the related MicroPost object from it.

# Create migration

> symfony console make:migration

# Apply migration to DBB

> symfony.exe console doctrine:migrations:migrate

### OneToMany Relation - Comment to Post

> 'LAZY'|'EAGER'|'EXTRA_LAZY'

### ManyToMany Relation - likes

> symfony console make:entity

> ![ManyToMany](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/05.jpg)

> symfony.exe console make:migration
> symfony.exe console doctrine:migrations:migrate

### FORM for Add Comments

> symfony console make:form -> /src/Form/CommentType.php

### Get posts with comments in One single Query

> MicroPostRepository.php -> public function findAllWithComments()
> MicroPostController.php -> Replace 'posts' => $posts->findAll() WITH 'posts' => $posts->findAllWithComments()

### Authentication & Authorization

> /config/packages/security.yaml

## Create User Accounts with Hashed Passwords

> AppFixtures.php -> public function \_\_construct(private UserPasswordHasherInterface $userPasswordHasher)

> symfony console doctrine:fixtures:load

## Command creating Users

> symfony console make:command -> app:create-user

> /src/Command/CreateUserCommand.php

# See comands

> symfony console app

# Add User in CreateUserCommand.php

> execute() -> $this->users->add($user, true);

# Command Line CreateUser

> symfony console app:create-user xxx@test.com 12345678

### FORM Login

> security.yaml -> firewalls:main:form_login:login_path: app_login

> symfony console make:controller -> LoginController.php

# Template Login

> /templates/login/index.html.twig -> actionForm is set in security.yaml

> ![SuccessLogin](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/06.jpg)

### FORM Logout

> security.yaml -> firewalls:main:logout:path:app_logout

> ![Logout](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/07.jpg)

### Link User to Posts, Comments (Author)

> symfony console make:entity

# DELETE Data in Database

> symfony console doctrine:schema:drop --force

# Create Schema for the empty database

> symfony console doctrine:schema:create

# Insert New Data

> AppFixtures.php -> $microPost3->setAuthor($user1);

# Load new Fixtures in Database

> symfony console doctrine:fixtures:load

### Current User

> MicroPostController.php -> $comment->setAuthor($this->getUser());

# Condition LoggedIn in twig template

> base.html.twig -> {% if app.user %}

### ROLES User MicroPostController.php

# Deny v1

> IS_AUTHENTICATED_FULLY, PUBLIC_ACCESS

# Deny V2

> #[IsGranted('IS_AUTHENTICATED_FULLY')]

# Deny V3

> security.yaml -> acces_control

### Add Created to Comments

> symfony console make:entity
> ![Add created to Comment](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/08.jpg)

### VOTERS

> symfony console make:voter

# New class

> /src/Security/Voter/MicroPostVoter.php -> voteOnAttribute()

# MicroPostController.php

> #[IsGranted(MicroPost::VIEW, 'post')]

### REGISTRATION

> symfony console make:registration-form

# New files

> registrationController.php & /src/Security/emailVerifier.php

> symfony console make:migration

## Register Form

> /src/Form/RegistrationFormType.php

### Mailer

# Mailtrap Symfony tutorial

> https://github.com/mailtrap/mailtrap-php/tree/main/src/Bridge/Symfony

> /config/services.yaml

# test email

> php bin/console mailer:test testemail@test.com

### Register Form

> /templates/registration/register.html.twig

## Errors on register form

# Unique email

> User.php -> #[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]

# Repeated PAssword

> /RegistrationFormType

### Be verified to add Posts

## ROLE_WRITER_VERIFIED

> User.php -> getRoles() -> if($this->isVerified())

# Post only if verified

> MicroPostController.php

```
#[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
#[IsGranted('ROLE_WRITER_VERIFIED')]
```

### User Checker

> https://symfony.com/doc/6.4/security/user_checkers.html

# Add property 'bannedUntil' for User

> ![Banned User](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/09.jpg)

# UserChecker for banned timedate

> /src/Security/UserChecker.php

### Update FIREWALL

> security.yaml -> user_checker: App\Security\UserChecker

> > ![Banned](https://github.com/samedandev/2520_symfony_social_web_app/blob/main/_printscreens/10.jpg)

# Checkers Tutorial

> https://symfony.com/doc/6.4/security/user_checkers.html

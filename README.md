# Slim Framework MVC Boilerplate

This is a boilerplate using [Slim Framework](https://slimframework.com), MVC pattern and third-party libraries.

**Documentation is still in progress. Hold on.**

## The goal

As described on Slim documentation, you don't always need a kitchen-sink solution like [Symfony](https://symfony.com) or [Laravel](https://laravel.com). Slim provides a minimal set of tools to build your application, which is great for APIs, but you miss some tools if you are using Slim to build something else, like a website with many features.

However, Slim also provides easy methods to use third-party libraries on your code. Almost everything you need is out there - Cache, CSRF protection, Database management, Logging, Mail solution, Templates and more.

But searching for those implementations can be a waste of your time. You can just use this boilerplate which covers it all for you using MVC pattern.

## Features

This boilerplate provides:

- All the features on [Slim Framework](http://slimframework.com) which includes dependency injection container, [PSR-7](https://github.com/php-fig/http-message) implementation and more.
- MVC pattern
- Cache - provided by [Symfony Cache](https://symfony.com/doc/current/components/cache.html)
- CSRF protection - provided by [Slim CSRF](https://github.com/slimphp/Slim-Csrf)
- Custom configuration variables - provided by [phpdotenv](https://github.com/vlucas/phpdotenv)
- Database migrations - provided by [Phinx](https://phinx.org)
- Database ORM - provided by [Laravel Eloquent](https://laravel.com/docs/5.5/eloquent)

   **If you don't need all the power in Eloquent, we also provide a simple CRUD class using [PDO](http://php.net/manual/pt_BR/book.pdo.php).**
- Fake data generation - provided by [Faker](https://github.com/fzaninotto/Faker)
- Logging - provided by [Monolog](https://github.com/Seldaek/monolog)
- Mail - provided by [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- Multi-language support - provided by [Laravel Localization](https://laravel.com/docs/5.5/localization)
- Session management - provided by [Slim Session](https://github.com/bryanjhv/slim-session)
- Slug for your pretty URLs - provided by [Slugify](https://github.com/cocur/slugify)
- Templates - provided by [Twig](https://twig.symfony.com) and [Twig-View helper](https://github.com/slimphp/Twig-View)

## Directory structure
- `app` - contains your application files
  - `Controller`  - contains your Controllers classes
  - `Handler` - contains your Handlers classes - like [Error Handlers](https://www.slimframework.com/docs/handlers/error.html)
  - `Helper` - contains your Helper classes
  - `Middleware` - contains your Middleware classes
  - `Model` - contains your Model classes
    - `Core` - contains Model classes fundamental for your application
- `bootstrap` - contains the files that will bootstrap your application (make it run)
  - `Twig` - contains your Twig-related classes like custom functions, custom tests, custom extensions and more
    - `CustomFunction` - contains your custom Twig functions
- `database` - contains your migrations and seeds provided by [Phinx](https://phinx.org)
- `lang` - constains your language strings provided by [Laravel Localization](https://laravel.com/docs/5.5/localization)
- `public` - contains the starting point (`index.php`). You should store your front-end production assets (CSS, JS, Images and Fonts) on this directory
- `storage` - used by the boilerplate to store Cache and Logs (must be **writable**)
- `web` - contains your front-end related files
  - `templates` - contains your templates provided by [Twig](https://twig.symfony.com)

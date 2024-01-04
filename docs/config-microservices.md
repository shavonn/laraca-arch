# Laraca Config: Microservices

Separate your application into microservices.

```php
    'microservices' => [
        'enabled' => true,
        'path' => 'Services', // dir name or null
        'parent' => 'app',
    ],
```

| Option |                               Description                               |
| ------ | :---------------------------------------------------------------------: |
| `path` | The directory you want to use as a parent. It can be whatever you like. |

Examples:

-   `'path' => 'Services'` => `(app/Services/Foo)`
-   `'path' => null` => `(app/Foo)`

## init:micro

This command will create a default microservice structure with service providers that will load routes and views into your application.
Just add your main service provider _(ex: FooServiceProvider.php)_ to `providers` in `config/app.php`.

```
init:micro Foo

Foo
├── Broadcasting
├── Http
│   ├── Controllers
│   └── Middleware
├── Providers
│   ├── BroadcastServiceProvider.php
│   └── RouteServiceProvider.php
├── resources
│   └── views
│       └── welcome.blade.php
├── routes
│       ├── api.php
│       ├── channels.php
│       └── web.php
├── tests
└── FooServiceProvider.php
```

Additionally, microservices can be added to [domains](/config-domains) using the `--domain` option flag.

## Use with make commands

When enabled, it adds an optional `--service` flag to all of Laraca's arti and make commands to route it to a particular service. It will use the directory path defined up until the `base` or `app` end.

**For example:**
Microservices path = `Services`
Controller path = `Http/Controllers`

`artisan make:controller FavoritesContoller` **`--service=Favorites`**

The job would generate at:
`app/Services/Favorites/Http/Controllers/FavoritesController.php`

## Associated commands

[domain:list](/additional-commands#domain-list)

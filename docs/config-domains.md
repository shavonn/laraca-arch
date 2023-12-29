# Laraca Config: Domains

If you're interested in domain-driven design or even separating your application into microservices in a monolith, enabling domains can do that with you.

```php
    'domains' => [
        'enabled' => true,
        'path' => 'Domains', // dir name or null
        'parent' => 'app',
    ],
```

| Option |                               Description                               |
| ------ | :---------------------------------------------------------------------: |
| `path` | The directory you want to use as a parent. It can be whatever you like. |

Examples:

-   `'path' => 'Domains'` => `(app/Domains/Foo)`
-   `'path' => 'Service'` => `(app/Service/Foo)`
-   `'path' => null` => `(app/Foo)`

## Use with make commands

When enabled, it adds an optional `domain` argument to all of Laraca's make commands except (Factories,Migrations, Providers, and Seeders) so **if** you want the file to generate in a particular domain, just pass it as the second arg.

`artisan make:controller FavoritesContoller` **`Favorites`**

## Associated commands

[domain:list](/additional-commands#domain-list)

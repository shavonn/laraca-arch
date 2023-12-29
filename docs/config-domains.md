# Laraca Config: Domains

If you're interested in domain-driven design or even separating your application into microservices in a monolith, enabling domains can do that with you.

```php
    'domains' => [
        'enabled' => true,
        'parent_dir' => 'Domains', // dir name or null
    ],
```

| Option       |                               Description                               |
| ------------ | :---------------------------------------------------------------------: |
| `parent_dir` | The directory you want to use as a parent. It can be whatever you like. |

Examples:

-   `'parent_dir' => 'Domains'` => `(app/Domains/Foo)`
-   `'parent_dir' => 'Service'` => `(app/Service/Foo)`
-   `'parent_dir' => null` => `(app/Foo)`

## Use with make commands

When enabled, it adds an optional `domain` argument to all of Laraca's make commands except (Factories,Migrations, Providers, and Seeders) so **if** you want the file to generate in a particular domain, just pass it as the second arg.

`artisan make:controller FavoritesContoller` **`Favorites`**

## Associated commands

[domain:list](/additional-commands#domain-list)

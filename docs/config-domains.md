# Laraca Config: Domains

If you're interested in domain-driven design or even separating your application into microservices in a monolith, enabling domains can do that with you.

When enabled, it adds an optional `domain` argument to all of Laraca's make commands.

```php
    'domains' => [
        'enabled' => true,
        'parent_dir' => 'Domain', // dir name or null
    ],
```

| Option       |                               Description                               |
| ------------ | :---------------------------------------------------------------------: |
| `parent_dir` | The directory you want to use as a parent. It can be whatever you like. |

Examples:

-   `'parent_dir' => 'Domain'` => `(app/Domain/Foo)`
-   `'parent_dir' => 'Service'` => `(app/Service/Foo)`
-   `'parent_dir' => null` => `(app/Foo)`

# Laraca Config: Domains

An option for domain-driven design.

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
-   `'path' => null` => `(app/Foo)`

## Use with make commands

When enabled, it adds an optional `--domain` flag to all of Laraca's arti and make commands to route it to a particular domain. It will use the directory path defined up until the `base` or `app` end.

**For example:**
Domain path = `Domains`
Job path = `Operations/Jobs`

`artisan make:job GenerateInvoice` **`--domain=Billing`**

The job would generate at:
`app/Domains/Billing/Operations/Jobs/GenerateInvoice.php`

## Associated commands

[domain:list](/additional-commands#domain-list)

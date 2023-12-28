# Laraca Config

## Domains

If you're interested in domain-driven-design or even separating your application into microservices in a monolith, domains can do that with you.

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
`'parent_dir' => 'Domain'` would yield `(app/Domain/Foo)`
`'parent_dir' => 'Service'` would yield `(app/Service/Foo)`
`'parent_dir' => null` would yield `(app/Foo)`

## Structure

Generally, every key in the config corresponds to a fairly obvious command. The path up through its parents are where those files will be generated.

### Parents

Build your directory structure through the `path` and `parent` keys. Normal nested ideals here.

**All that matters is that every key must, itself or through its lineage, lead back to a parent of `app` or `base`.**
_App being inside the `app/` folder and base being the application root directory (parent to app/ in a fresh Laravel install)._

#### Parent

When you want a directory that is just a parent to others, there are two ways to do that:

Additional keys can be added to the `structure` to serve as parent directories.

```php
'data' => [
    'path' => 'Data',
    'parent' => 'app',
],
'model' => [
    'path' => 'Models',
    'parent' => 'data',
],
```

Results: `app/Data/Models`

#### Path

Or avoid bloat in your config and just put it in its path.

```php
'model' => [
    'path' => 'Data/Models',
    'parent' => 'app',
],
```

Results: `app/Data/Models`

### Key Notes

#### view

If the laraca config `view` key is not set or throws an error, the command will use the Laravel view path from `config/view.php`.
Why? So, people can use the available Laravel config if they so choose. And since it's there, as a backup if the path fails due to a missing parent.

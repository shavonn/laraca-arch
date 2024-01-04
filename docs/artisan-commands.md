---
outline: deep
---

# Artisan Commands

These are Laravel Artisan commands wrapped so that your custom directory structure is easy to use.

Most, if not all options will work as they are extended from the original commands. However, if there's some options that I haven't used, I may not have accounted for them. In that case, [feel free to let me know](https://github.com/handsomebrown/laraca-arch/discussions) or throw a PR my way.

Caveats:

-   `make:migration` isn't wrapped. You will need to use `arti:migration`. Why? This one is quite different from the others and more difficult to tinker with than I was willing to lend time to. It’s better just left as is, in my humble opinion.

## arti:migration

```bash
artisan arti:migration [name]
```

Extends `artisan make:migration`

Default dir in config: `database/migrations`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:cast

```bash
artisan make:cast [name]
```

Extends `artisan make:cast`

Default dir in config: `app/Data/Casts`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:channel

```bash
artisan make:channel [name]
```

Extends `artisan make:channel`

Default dir in config: `app/Broadcasting`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:command

```bash
artisan make:command [name]
```

Extends `artisan make:command`

Default dir in config: `app/Console/Commands`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:component

```bash
artisan make:component [name]
```

Extends `artisan make:component`

Default dir in config: `app/View/Components`

### Note

-   Depends on the [Config view key](/config-structure#view)

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:controller

```bash
artisan make:controller [name]
```

Extends `artisan make:controller`

Default dir in config: `app/Http/Controllers`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:enum

```bash
artisan make:enum [name]
```

Default dir in config: `app/Enums`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:event

```bash
artisan make:event [name]
```

Extends `artisan make:event`

Default dir in config: `app/Events`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:exception

```bash
artisan make:exception [name]
```

Extends `artisan make:exception`

Default dir in config: `app/Exceptions`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:factory

```bash
artisan make:factory [name]
```

Extends `artisan make:factory`

Default dir in config: `database/factories`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:job

```bash
artisan make:job [name]
```

Extends `artisan make:job`

Default dir in config: `app/Jobs`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:listener

```bash
artisan make:listener [name]
```

Extends `artisan make:listener`

Default dir in config: `app/Listeners`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:mail

```bash
artisan make:mail [name]
```

Extends `artisan make:mail`

Default dir in config: `app/Mail`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:middleware

```bash
artisan make:middleware [name]
```

Extends `artisan make:middleware`

Default dir in config: `app/Http/Middlewares`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:model

```bash
artisan make:model [name]
```

Extends `artisan make:model`

Default dir in config: `app/Data/Models`

### Note

-   The artisan `--all` for this command doesn't work _yet_.

### Additions

| Option      |           Description            |
| ----------- | :------------------------------: |
| `--uuid`    | Adds the HasUuids trait to model |
| `--service` |      Add to a microservice       |
| `--domain`  |         Add to a domain          |

## make:notification

```bash
artisan make:notification [name]
```

Extends `artisan make:notification`

Default dir in config: `app/Notifications`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:observer

```bash
artisan make:observer [name]
```

Extends `artisan make:observer`

Default dir in config: `app/Data/Observers`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:policy

```bash
artisan make:policy [name]
```

Extends `artisan make:policy`

Default dir in config: `app/Policies`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:provider

```bash
artisan make:provider [name]
```

Extends `artisan make:provider`

Default dir in config: `app/Providers`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:request

```bash
artisan make:request [name]
```

Extends `artisan make:request`

Default dir in config: `app/Http/Requests`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:resource

```bash
artisan make:resource [name]
```

Extends `artisan make:resource`

Default dir in config: `app/Http/Resources`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:rule

```bash
artisan make:rule [name]
```

Extends `artisan make:rule`

Default dir in config: `app/Rules`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:scope

```bash
artisan make:scope [name]
```

Extends `artisan make:scope`

Default dir in config: `app/Data/Models/Scopes`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:seeder

```bash
artisan make:seeder [name]
```

Extends `artisan make:seeder`

Default dir in config: `database/seeders`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:test

```bash
artisan make:test [name]
```

Extends `artisan make:test`

Default dir in config: `tests`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:value

```bash
artisan make:value [name]
```

Default dir in config: `app/Data/Values`

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

## make:view

```bash
artisan make:view [name]
```

Extends `artisan make:view`

Default dir in config: `resources/views`

### Note

-   Depends on the [Config view key](/config-structure#view)

### Additions

| Option      |      Description      |
| ----------- | :-------------------: |
| `--service` | Add to a microservice |
| `--domain`  |    Add to a domain    |

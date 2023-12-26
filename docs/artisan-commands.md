---
outline: deep
---

# Artisan Commands

These are Laravel Artisan commands I've wrapped so that your custom directory structure is easy to implement it.

Caveats:

-   `make:migration` isn't wrapped. You will need to use `arti:migration`. Why? This one is quite different from the others and more difficult to tinker with than I was willing to lend time to. It’s better just left as is, in my humble opinion.

## arti:migration

```shell
artisan arti:migration [name]
```

Extends `artisan make:migration`

Default dir in config: `database/migrations`

## make:cast

```shell
artisan make:cast [name]
```

Extends `artisan make:cast`

Default dir in config: `app/Data/Casts`

## make:channel

```shell
artisan make:channel [name]
```

Extends `artisan make:channel`

Default dir in config: `app/Broadcasting`

## make:command

```shell
artisan make:command [name]
```

Extends `artisan make:command`

Default dir in config: `app/Console/Commands`

## make:component

```shell
artisan make:component [name]
```

Extends `artisan make:component`

Default dir in config: `app/View/Components`

### Note

-   Depends on the [Config view key](/config#view)

## make:controller

```shell
artisan make:controller [name]
```

Extends `artisan make:controller`

Default dir in config: `app/Http/Controllers`

## make:enum

```shell
artisan make:enum [name]
```

Default dir in config: `app/Enums`

## make:event

```shell
artisan make:event [name]
```

Extends `artisan make:event`

Default dir in config: `app/Events`

## make:exception

```shell
artisan make:exception [name]
```

Extends `artisan make:exception`

Default dir in config: `app/Exceptions`

## make:factory

```shell
artisan make:factory [name]
```

Extends `artisan make:factory`

Default dir in config: `database/factories`

## make:job

```shell
artisan make:job [name]
```

Extends `artisan make:job`

Default dir in config: `app/Jobs`

## make:listener

```shell
artisan make:listener [name]
```

Extends `artisan make:listener`

Default dir in config: `app/Listeners`

## make:mail

```shell
artisan make:mail [name]
```

Extends `artisan make:mail`

Default dir in config: `app/Mail`

## make:middleware

```shell
artisan make:middleware [name]
```

Extends `artisan make:middleware`

Default dir in config: `app/Http/Middlewares`

## make:model

```shell
artisan make:model [name]
```

Extends `artisan make:model`

Default dir in config: `app/Data/Models`

### Note

-   The artisan `--all` for this command doesn't work _yet_.

### Additions

| Option   |           Description            |
| -------- | :------------------------------: |
| `--uuid` | Adds the HasUuids trait to model |

## make:notification

```shell
artisan make:notification [name]
```

Extends `artisan make:notification`

Default dir in config: `app/Notifications`

## make:observer

```shell
artisan make:observer [name]
```

Extends `artisan make:observer`

Default dir in config: `app/Data/Observers`

## make:policy

```shell
artisan make:policy [name]
```

Extends `artisan make:policy`

Default dir in config: `app/Policies`

## make:provider

```shell
artisan make:provider [name]
```

Extends `artisan make:provider`

Default dir in config: `app/Providers`

## make:request

```shell
artisan make:request [name]
```

Extends `artisan make:request`

Default dir in config: `app/Http/Requests`

## make:resource

```shell
artisan make:resource [name]
```

Extends `artisan make:resource`

Default dir in config: `app/Http/Resources`

## make:rule

```shell
artisan make:rule [name]
```

Extends `artisan make:rule`

Default dir in config: `app/Rules`

## make:scope

```shell
artisan make:scope [name]
```

Extends `artisan make:scope`

Default dir in config: `app/Data/Models/Scopes`

## make:seeder

```shell
artisan make:seeder [name]
```

Extends `artisan make:seeder`

Default dir in config: `database/seeders`

## make:structure

```shell
artisan make:structure [name]
```

Generates full directory structure defined in the Laraca config file.

## make:test

```shell
artisan make:test [name]
```

Extends `artisan make:test`

Default dir in config: `tests`

## make:value

```shell
artisan make:value [name]
```

Default dir in config: `Data\Values`

## make:view

```shell
artisan make:view [name]
```

Extends `artisan make:view`

Default dir in config: `resources/views`

### Note

-   Depends on the [Config view key](/config#view)

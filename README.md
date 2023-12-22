# Laraca Architect

[![Latest Version on Packagist](https://img.shields.io/packagist/v/handsomebrown/laraca-arch.svg?style=flat-square)](https://packagist.org/packages/handsomebrown/laraca-arch)
[![Total Downloads](https://img.shields.io/packagist/dt/handsomebrown/laraca-arch.svg?style=flat-square)](https://packagist.org/packages/handsomebrown/laraca-arch)
![GitHub Actions](https://github.com/handsomebrown/laraca-arch/actions/workflows/main.yml/badge.svg)

The goal of this package is a _configurable_ Laravel application structure with a few niceties thrown in. And I swear only tiny bits of my personal opinion made it into the default configuration. ;)

## Installation

You can install the package via composer:

```bash
composer require handsomebrown/laraca-arch
```

You can publish the config file with:You can publish the config file with:k

```
php artisan vendor:publish --tag="laraca-config"
```

## Usage

Laraca Architect overwrites and extends Laravel Artisan commands. Hence, they still have all of the arguments and options artisan commands do, but use the directory structure you define in the Laraca config file.

Caveats:

-   `make:migration` is omitted. You will need to use `arty:migration`. Why? This one is quite different from the others and more difficult to tinker with than I was willing to lend time to. It’s better just left as is.

#### make:cast

```php
artisan make:cast <name>
```

Extends `artisan make:cast`
Default dir in config: `app/Data/Casts`

#### make:channel

```php
artisan make:channel <name>
```

Extends `artisan make:channel`
Default dir in config: `app/Broadcasting`

#### make:command

```php
artisan make:command <name>
```

Extends `artisan make:command`
Default dir in config: `app/Console/Commands`

#### make:component

```php
artisan make:component <name>
```

Extends `artisan make:component`
Default dir in config: `app/View/Components`

Note:

-   This command will use the laraca view path config value instead of the one set in `config/view.php` when generating the blade file.

#### make:controller

```php
artisan make:controller <name>
```

Extends `artisan make:controller`
Default dir in config: `app/Http/Controllers`

#### make:event

```php
artisan make:event <name>
```

Extends `artisan make:event`
Default dir in config: `app/Events`

#### make:exception

```php
artisan make:exception <name>
```

Extends `artisan make:exception`
Default dir in config: `app/Exceptions`

#### make:factory

```php
artisan make:factory <name>
```

Extends `artisan make:factory`
Default dir in config: `database/factories`

#### make:job

```php
artisan make:job <name>
```

Extends `artisan make:job`
Default dir in config: `app/Jobs`

#### make:listener

```php
artisan make:listener <name>
```

Extends `artisan make:listener`
Default dir in config: `app/Listeners`

#### make:mail

```php
artisan make:mail <name>
```

Extends `artisan make:mail`
Default dir in config: `app/Mail`

#### make:middleware

```php
artisan make:middleware <name>
```

Extends `artisan make:middleware`
Default dir in config: `app/Http/Middlewares`

#### arty:migration

```php
artisan make:migration <name>
```

Extends `artisan make:migration`
Default dir in config: `database/migrations`

#### make:model

```php
artisan make:model <name>
```

Extends `artisan make:model`
Default dir in config: `app/Data/Models`

Note:

-   `--all` doesn't work _yet_.
-   Additional option of `--uuid` will add the HasUuids trait for you.

#### make:notification

```php
artisan make:notification <name>
```

Extends `artisan make:notification`
Default dir in config: `app/Notifications`

#### make:observer

```php
artisan make:observer <name>
```

Extends `artisan make:observer`
Default dir in config: `app/Data/Observers`

#### make:policy

```php
artisan make:policy <name>
```

Extends `artisan make:policy`
Default dir in config: `app/Policies`

#### make:provider

```php
artisan make:provider <name>
```

Extends `artisan make:provider`
Default dir in config: `app/Providers`

#### make:request

```php
artisan make:request <name>
```

Extends `artisan make:request`
Default dir in config: `app/Http/Requests`

#### make:resource

```php
artisan make:resource <name>
```

Extends `artisan make:resource`
Default dir in config: `app/Http/Resources`

#### make:rule

```php
artisan make:rule <name>
```

Extends `artisan make:rule`
Default dir in config: `app/Rules`

#### make:scope

```php
artisan make:scope <name>
```

Extends `artisan make:scope`
Default dir in config: `app/Data/Models/Scopes`

#### make:seeder

```php
artisan make:seeder <name>
```

Extends `artisan make:seeder`
Default dir in config: `database/seeders`

#### make:test

```php
artisan make:test <name>
```

Extends `artisan make:test`
Default dir in config: `tests`

#### make:view

```php
artisan make:view <name>
```

Extends `artisan make:view`
Default dir in config: `resources/views`

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dev@handsomebrown.com instead of using the issue tracker.

## Credits

-   [Shavonn Brown](https://github.com/handsomebrown)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

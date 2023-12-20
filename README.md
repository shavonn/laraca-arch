# Laraca

[![Latest Version on Packagist](https://img.shields.io/packagist/v/handsomebrown/laraca.svg?style=flat-square)](https://packagist.org/packages/handsomebrown/laraca)
[![Total Downloads](https://img.shields.io/packagist/dt/handsomebrown/laraca.svg?style=flat-square)](https://packagist.org/packages/handsomebrown/laraca)
![GitHub Actions](https://github.com/handsomebrown/laraca/actions/workflows/main.yml/badge.svg)

The goal of this package is an alternate _configurable_ Laravel application structure with a few niceties thrown in.

## Installation

You can install the package via composer:

```bash
composer require handsomebrown/laraca
```

## Usage

Meet `arty` ( obviously named after Laravel's `artisan`), the command namespace where you can find Laraca commands that wrap Laravel's Artisan command classes so you can have the application structure you want.

Arty extends existing Laravel Artisan commands so they still have all of the arguments and options artisan commands do.

#### arty:cast

```php
artisan arty:cast <name>
```

Extends `artisan make:cast`
Default dir in config: `Data\Casts`

#### arty:channel

```php
artisan arty:channel <name>
```

Extends `artisan make:channel`
Default dir in config: `app/Broadcasting`

#### arty:command

```php
artisan arty:command <name>
```

Extends `artisan make:command`
Default dir in config: `app/Console\Commands`

#### arty:component

```php
artisan arty:component <name>
```

Extends `artisan make:component`
Default dir in config: `app/View\Components`

Note:

- This command will use the laraca view path config value instead of the one set in `config/view.php` when generating the blade file.

#### arty:controller

```php
artisan arty:controller <name>
```

Extends `artisan make:controller`
Default dir in config: `app/Http/Controllers`

#### arty:event

```php
artisan arty:event <name>
```

Extends `artisan make:event`
Default dir in config: `app/Events`

#### arty:exception

```php
artisan arty:exception <name>
```

Extends `artisan make:exception`
Default dir in config: `app/xceptions`

#### arty:factory

```php
artisan arty:factory <name>
```

Extends `artisan make:factory`
Default dir in config: `database/factories`

#### arty:job

```php
artisan arty:job <name>
```

Extends `artisan make:job`
Default dir in config: `app/Jobs`

#### arty:listener

```php
artisan arty:listener <name>
```

Extends `artisan make:listener`
Default dir in config: `app/Listeners`

#### arty:mail

```php
artisan arty:mail <name>
```

Extends `artisan make:mail`
Default dir in config: `app/Mail`

#### arty:middleware

```php
artisan arty:middleware <name>
```

Extends `artisan make:middleware`
Default dir in config: `app/Http/Middlewares`

#### arty:migration

```php
artisan arty:migration <name>
```

Extends `artisan make:migration`
Default dir in config: `database/migrations`

#### arty:model

```php
artisan arty:model <name>
```

Extends `artisan make:model`
Default dir in config: `app/Data/Models`

Note:

- `--all` doesn't work _yet_.
- Additional option of `--uuid` will add the HasUuids trait for you.

#### arty:notification

```php
artisan arty:notification <name>
```

Extends `artisan make:notification`
Default dir in config: `app/Notifications`

#### arty:observer

```php
artisan arty:observer <name>
```

Extends `artisan make:observer`
Default dir in config: `app/Data/Observers`

#### arty:policy

```php
artisan arty:policy <name>
```

Extends `artisan make:policy`
Default dir in config: `app/Policies`

#### arty:provider

```php
artisan arty:provider <name>
```

Extends `artisan make:provider`
Default dir in config: `app/Providers`

#### arty:request

```php
artisan arty:request <name>
```

Extends `artisan make:request`
Default dir in config: `app/Http/Requests`

#### arty:resource

```php
artisan arty:resource <name>
```

Extends `artisan make:resource`
Default dir in config: `app/Http/Resources`

#### arty:rule

```php
artisan arty:rule <name>
```

Extends `artisan make:rule`
Default dir in config: `app/Rules`

#### arty:scope

```php
artisan arty:scope <name>
```

Extends `artisan make:scope`
Default dir in config: `app/Data/Models/Scopes`

#### arty:seeder

```php
artisan arty:seeder <name>
```

Extends `artisan make:seeder`
Default dir in config: `database/seeders`

#### arty:test

```php
artisan arty:test <name>
```

Extends `artisan make:test`
Default dir in config: `tests`

#### arty:view

```php
artisan arty:view <name>
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

- [Shavonn Brown](https://github.com/handsomebrown)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

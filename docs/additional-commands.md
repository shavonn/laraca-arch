---
outline: deep
---

# Additional Commands

Additional, custom artisan commands provided by this package.

## domain:list\*

This command is only available when domains are enabled _and_ a `parent_dir` is set.

```bash
artisan domain:list
```

Generates full list of domain names.

## init:micro

```bash
artisan init:micro [name]
```

Generates [microservice](/config-microservices#init-micro).

## init:structure

```bash
artisan init:structure
```

Generates full directory structure defined in the Laraca config file.

## make:enum

```bash
artisan make:enum [name]
```

Default dir in config: `app/Enums`

## make:strategy

```bash
artisan make:strategy [name]
```

Default dir in config: `app/Strategy`

## make:value

```bash
artisan make:value [name]
```

Default dir in config: `Data/Values`

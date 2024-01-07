<?php

use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(HandsomeBrown\Laraca\Tests\LaracaTestCase::class)->in(__DIR__);

/**
 * getConfigPath
 */
function getConfigPath(string $key, ?string $domain = null, ?string $service = null): string
{
    return HandsomeBrown\Laraca\Traits\GetsConfigValues::getConfigPath($key, $domain, $service);
}

/**
 * getConfigNamespace
 */
function getConfigNamespace(string $key): string
{
    return HandsomeBrown\Laraca\Traits\GetsConfigValues::getConfigNamespace($key);
}

/**
 * getName
 *
 * @return \Illuminate\Support\Stringable
 */
function getName(string $name)
{
    return Str::of($name)->ucfirst();
}

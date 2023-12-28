<?php

use HandsomeBrown\Laraca\Tests\LaracaTestCase;

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

uses(LaracaTestCase::class)->in(__DIR__);

use HandsomeBrown\Laraca\Concerns\GetsConfigValues;

/**
 * assemblePath
 *
 * @param  string  $key
 */
function assembleFullPath($key, $domain = null): string
{
    return GetsConfigValues::assembleFullPath($key, $domain);
}

/**
 * assembleNamespace
 *
 * @param  string  $key
 */
function assembleNamespace($key): string
{
    return GetsConfigValues::assembleNamespace($key);
}

/**
 * fullNamespaceStr
 */
function fullNamespaceStr(string $namespace, bool $app = true): string
{
    return 'namespace '.$namespace.';';
}

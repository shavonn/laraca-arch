<?php

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
 * assemblePath
 *
 * @param  string  $key
 */
function assembleFullPath($key, $domain = null): string
{
    return HandsomeBrown\Laraca\Traits\GetsConfigValues::assembleFullPath($key, $domain);
}

/**
 * assembleNamespace
 *
 * @param  string  $key
 */
function assembleNamespace($key): string
{
    return HandsomeBrown\Laraca\Traits\GetsConfigValues::assembleNamespace($key);
}

/**
 * fullNamespaceStr
 */
function fullNamespaceStr(string $namespace, bool $app = true): string
{
    return 'namespace '.$namespace.';';
}

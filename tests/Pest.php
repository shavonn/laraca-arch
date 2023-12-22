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

/**
 * namespaceToPath
 */
function namespaceToPath(string $namespace): string
{
    return str_replace('\\', '/', $namespace);
}

/**
 * pathToNamespace
 */
function pathToNamespace(string $path): string
{
    $strArry = explode('/', $path);
    $strArry = array_map(function ($str) {
        return ucfirst($str);
    }, $strArry);

    return implode('\\', $strArry);
}

/**
 * fullNamespaceStr
 */
function fullNamespaceStr(string $namespace, bool $app = true): string
{
    if ($app) {
        return 'namespace '.app()->getNamespace().$namespace.';';
    }

    return 'namespace '.$namespace.';';
}

/**
 * getDatabasePath
 */
function getDatabasePath(string $configKey): string
{
    return strtolower(config('laraca.database.path').DIRECTORY_SEPARATOR.config($configKey));
}

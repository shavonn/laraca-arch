<?php

namespace HandsomeBrown\Laraca\Tests;

use HandsomeBrown\Laraca\LaracaServiceProvider;
use Orchestra\Testbench\TestCase;

class LaracaTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMockingConsoleOutput();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaracaServiceProvider::class,
        ];
    }
}

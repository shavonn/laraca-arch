<?php

namespace HandsomeBrown\Laraca\Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class LaracaTestCase extends TestCase
{
    /**
     * setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMockingConsoleOutput();

        $this->beforeApplicationDestroyed(function () {
            File::deleteDirectories(base_path('db'));
            File::deleteDirectories(app_path('Test'));
            File::deleteDirectories(base_path('test'));
        });

        // File::cleanDirectory(app_path());
    }

    /**
     * getPackageProviders
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaracaTestServiceProvider::class,
        ];
    }
}

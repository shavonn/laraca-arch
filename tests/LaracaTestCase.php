<?php

namespace HandsomeBrown\Laraca\Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase;

class LaracaTestCase extends TestCase
{
    use WithWorkbench;

    /**
     * setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMockingConsoleOutput();

        $this->afterApplicationCreated(function () {
            File::makeDirectory(app_path('Test'));
            File::makeDirectory(base_path('test'));
        });

        $this->beforeApplicationDestroyed(function () {
            File::deleteDirectories(app_path('Test'));
            File::deleteDirectories(base_path('test'));
        });
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

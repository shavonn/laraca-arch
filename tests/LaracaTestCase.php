<?php

namespace HandsomeBrown\Laraca\Tests;

use HandsomeBrown\Laraca\LaracaServiceProvider;
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

        $this->beforeApplicationDestroyed(function () {
            if (File::exists(app_path('Test'))) {
                File::deleteDirectories(app_path('Test'));
            }
            if (File::exists(app_path('AreaB'))) {
                File::deleteDirectories(app_path('AreaB'));
            }
            if (File::exists(app_path('TopicA'))) {
                File::deleteDirectories(app_path('TopicA'));
            }
            if (File::exists(base_path('test'))) {
                File::deleteDirectories(base_path('test'));
            }
            if (File::exists(base_path('tests'))) {
                File::deleteDirectories(base_path('tests'));
            }
            if (File::exists(base_path('resources'))) {
                File::deleteDirectories(base_path('resources'));
            }
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
            LaracaServiceProvider::class,
        ];
    }
}

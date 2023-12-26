<?php

namespace HandsomeBrown\Laraca\Tests;

use HandsomeBrown\Laraca\LaracaServiceProvider;
use Illuminate\Support\Facades\Config;
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
            if (! File::exists(app_path('Test'))) {
                File::makeDirectory(app_path('Test'));
            }
            if (! File::exists(base_path('test'))) {
                File::makeDirectory(base_path('test'));
            }

            /* set test paths
            * @TODO move to tests
            */
            Config::set('laraca.database.path', 'test/database');
            Config::set('laraca.cast.namespace', 'Test\Data\Casts');
            Config::set('laraca.channel.namespace', 'Test\Broadcasting');
            Config::set('laraca.command.namespace', 'Test\Console\Commands');
            Config::set('laraca.component.namespace', 'Test\View\Components');
            Config::set('laraca.controller.namespace', 'Test\Http\Controllers');
            Config::set('laraca.event.namespace', 'Test\Events');
            Config::set('laraca.enum.namespace', 'Test\Enums');
            Config::set('laraca.exception.namespace', 'Test\Exceptions');
            Config::set('laraca.job.namespace', 'Test\Jobs');
            Config::set('laraca.listener.namespace', 'Test\Listeners');
            Config::set('laraca.mail.namespace', 'Test\Mail');
            Config::set('laraca.middleware.namespace', 'Test\Http\Middleware');
            Config::set('laraca.model.namespace', 'Test\Data\Models');
            Config::set('laraca.notification.namespace', 'Test\Notifications');
            Config::set('laraca.observer.namespace', 'Test\Data\Observers');
            Config::set('laraca.policy.namespace', 'Test\Policies');
            Config::set('laraca.provider.namespace', 'Test\Providers');
            Config::set('laraca.request.namespace', 'Test\Http\Requests');
            Config::set('laraca.resource.namespace', 'Test\Http\Resources');
            Config::set('laraca.rule.namespace', 'Test\Rules');
            Config::set('laraca.test.path', 'test/tests');
            Config::set('laraca.value.namespace', 'Test\Data\Values');
            Config::set('laraca.view.path', 'test/resources/views');
        });

        $this->beforeApplicationDestroyed(function () {
            if (File::exists(app_path('Test'))) {
                File::deleteDirectories(app_path('Test'));
            }
            if (File::exists(base_path('test'))) {
                File::deleteDirectories(base_path('test'));
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

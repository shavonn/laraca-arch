<?php

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:structure', function () {
    it('should create directory Structure from config', function () {
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
        expect($this->artisan('make:structure'))
            ->toBe(0);

        $paths = [
            'test/database',
            'app/Test/Data/Casts',
            'app/Test/Broadcasting',
            'app/Test/Console/Commands',
            'app/Test/View/Components',
            'app/Test/Http/Controllers',
            'app/Test/Events',
            'app/Test/Enums',
            'app/Test/Exceptions',
            'test/database/factories',
            'app/Test/Jobs',
            'app/Test/Listeners',
            'app/Test/Mail',
            'app/Test/Http/Middleware',
            'test/database/migrations',
            'app/Test/Data/Models',
            'app/Test/Notifications',
            'app/Test/Data/Observers',
            'app/Test/Policies',
            'app/Test/Providers',
            'app/Test/Http/Requests',
            'app/Test/Http/Resources',
            'app/Test/Rules',
            'app/Test/Data/Models/Scopes',
            'test/database/seeders',
            'test/tests',
            'app/Test/Data/Values',
            'test/resources/views',
        ];

        foreach ($paths as $p) {
            $dirPath = base_path($p);
            expect(File::isDirectory($dirPath))
                ->toBe(true, "Directory not created:\n".$dirPath."\n");

            $keepFile = $dirPath.'/.gitkeep';
            expect(File::exists($keepFile))
                ->toBe(true, "File not created at expected path:\n".$keepFile."\n\n");
        }

    })->with('classes');

    it('should throw a MissingPathNamespaceKeyException when a key has no path or namespace', function () {
        Config::set('laraca.empty_key', []);
        Config::set('laraca.command.parent', 'empty_key');

        $this->artisan('make:structure');

    })->with('classes')->throws(MissingPathNamespaceKeyException::class);

    it('should throw a InvalidConfigKeyException when a parent key does not exist in the config', function () {
        Config::set('laraca.model.parent', 'nonexistent_key');

        $this->artisan('make:structure');

    })->with('classes')->throws(InvalidConfigKeyException::class);

    it('should throw a MissingRootPathException when a tree does not lead to a base or app parent', function () {
        Config::set('laraca.model.parent', '');

        $this->artisan('make:structure');

    })->with('classes')->throws(MissingRootPathException::class);
});

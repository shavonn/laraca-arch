<?php

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('init:structure', function () {
    it('should create directory Structure from config', function () {
        Config::set('laraca.struct.database.path', 'test/database');
        Config::set('laraca.struct.cast.path', 'Test/Data/Casts');
        Config::set('laraca.struct.channel.path', 'Test/Broadcasting');
        Config::set('laraca.struct.command.path', 'Test/Console/Commands');
        Config::set('laraca.struct.component.path', 'Test/View/Components');
        Config::set('laraca.struct.controller.path', 'Test/Http/Controllers');
        Config::set('laraca.struct.event.path', 'Test/Events');
        Config::set('laraca.struct.enum.path', 'Test/Enums');
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');
        Config::set('laraca.struct.job.path', 'Test/Jobs');
        Config::set('laraca.struct.listener.path', 'Test/Listeners');
        Config::set('laraca.struct.mail.path', 'Test/Mail');
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');
        Config::set('laraca.struct.model.path', 'Test/Data/Models');
        Config::set('laraca.struct.notification.path', 'Test/Notifications');
        Config::set('laraca.struct.observer.path', 'Test/Data/Observers');
        Config::set('laraca.struct.policy.path', 'Test/Policies');
        Config::set('laraca.struct.provider.path', 'Test/Providers');
        Config::set('laraca.struct.request.path', 'Test/Http/Requests');
        Config::set('laraca.struct.resource.path', 'Test/Http/Resources');
        Config::set('laraca.struct.rule.path', 'Test/Rules');
        Config::set('laraca.struct.test.path', 'test/tests');
        Config::set('laraca.struct.value.path', 'Test/Data/Values');
        Config::set('laraca.struct.view.path', 'test/resources/views');

        artisan('init:structure');
        $output = Artisan::output();

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
            expect($keepFile)
                ->toBeFile("File not created at expected path:\n$keepFile\n\nOutput results:\n$output\n=====\n");
        }
    });

    it('throws a MissingPathNamespaceKeyException when a key has no path or namespace', function () {
        Config::set('laraca.struct.empty_key', []);
        Config::set('laraca.struct.command.parent', 'empty_key');

        artisan('init:structure');

    })->throws(MissingPathNamespaceKeyException::class);

    it('throws an InvalidConfigKeyException when a parent key does not exist in the config', function () {
        Config::set('laraca.struct.model.parent', 'nonexistent_key');

        artisan('init:structure');

    })->throws(InvalidConfigKeyException::class);

    it('throws a MissingRootPathException when a tree does not lead to a base or app parent', function () {
        Config::set('laraca.struct.model.parent', '');

        artisan('init:structure');

    })->throws(MissingRootPathException::class);
});

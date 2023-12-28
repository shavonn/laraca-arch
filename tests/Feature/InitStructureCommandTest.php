<?php

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('init:structure', function () {
    it('should create directory Structure from config', function () {
        Config::set('laraca.structure.database.path', 'test/database');
        Config::set('laraca.structure.cast.path', 'Test/Data/Casts');
        Config::set('laraca.structure.channel.path', 'Test/Broadcasting');
        Config::set('laraca.structure.command.path', 'Test/Console/Commands');
        Config::set('laraca.structure.component.path', 'Test/View/Components');
        Config::set('laraca.structure.controller.path', 'Test/Http/Controllers');
        Config::set('laraca.structure.event.path', 'Test/Events');
        Config::set('laraca.structure.enum.path', 'Test/Enums');
        Config::set('laraca.structure.exception.path', 'Test/Exceptions');
        Config::set('laraca.structure.job.path', 'Test/Jobs');
        Config::set('laraca.structure.listener.path', 'Test/Listeners');
        Config::set('laraca.structure.mail.path', 'Test/Mail');
        Config::set('laraca.structure.middleware.path', 'Test/Http/Middleware');
        Config::set('laraca.structure.model.path', 'Test/Data/Models');
        Config::set('laraca.structure.notification.path', 'Test/Notifications');
        Config::set('laraca.structure.observer.path', 'Test/Data/Observers');
        Config::set('laraca.structure.policy.path', 'Test/Policies');
        Config::set('laraca.structure.provider.path', 'Test/Providers');
        Config::set('laraca.structure.request.path', 'Test/Http/Requests');
        Config::set('laraca.structure.resource.path', 'Test/Http/Resources');
        Config::set('laraca.structure.rule.path', 'Test/Rules');
        Config::set('laraca.structure.test.path', 'test/tests');
        Config::set('laraca.structure.value.path', 'Test/Data/Values');
        Config::set('laraca.structure.view.path', 'test/resources/views');
        expect($this->artisan('init:structure'))
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

    it('throws a MissingPathNamespaceKeyException when a key has no path or namespace', function () {
        Config::set('laraca.structure.empty_key', []);
        Config::set('laraca.structure.command.parent', 'empty_key');

        $this->artisan('init:structure');

    })->with('classes')->throws(MissingPathNamespaceKeyException::class);

    it('throws an InvalidConfigKeyException when a parent key does not exist in the config', function () {
        Config::set('laraca.structure.model.parent', 'nonexistent_key');

        $this->artisan('init:structure');

    })->with('classes')->throws(InvalidConfigKeyException::class);

    it('throws a MissingRootPathException when a tree does not lead to a base or app parent', function () {
        Config::set('laraca.structure.model.parent', '');

        $this->artisan('init:structure');

    })->with('classes')->throws(MissingRootPathException::class);
});

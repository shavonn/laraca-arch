<?php

use HandsomeBrown\Laraca\Exceptions\InvalidConfigKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingPathNamespaceKeyException;
use HandsomeBrown\Laraca\Exceptions\MissingRootPathException;
use HandsomeBrown\Laraca\Foundation\Console\MakeStructureCommand;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:structure', function () {
    it('should create directory Structure from config', function () {
        expect($this->artisan(MakeStructureCommand::class))
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
        }

    })->with('classes');

    it('should throw a MissingPathNamespaceKeyException when a key has no path or namespace', function () {
        Config::set('laraca.empty_key', []);
        Config::set('laraca.command.parent', 'empty_key');

        $this->artisan(MakeStructureCommand::class);

    })->with('classes')->throws(MissingPathNamespaceKeyException::class);

    it('should throw a InvalidConfigKeyException when a parent key does not exist in the config', function () {
        Config::set('laraca.model.parent', 'nonexistent_key');

        $this->artisan(MakeStructureCommand::class);

    })->with('classes')->throws(InvalidConfigKeyException::class);

    it('should throw a MissingRootPathException when a tree does not lead to a base or app parent', function () {
        Config::set('laraca.model.parent', '');

        $this->artisan(MakeStructureCommand::class);

    })->with('classes')->throws(MissingRootPathException::class);
});

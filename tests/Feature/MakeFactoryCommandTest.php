<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeFactoryCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:factory', function () {
    it('should create Factory class at path from namespace', function (string $class) {
        $this->artisan(
            MakeFactoryCommand::class,
            ['name' => $class],
        );

        $configPath = getDatabasePath('laraca.factory.path');
        $filePath = base_path("$configPath/{$class}Factory.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Factory class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeFactoryCommand::class,
            ['name' => $class],
        );

        $configPath = getDatabasePath('laraca.factory.path');
        $configNamespace = fullNamespaceStr(pathToNamespace($configPath), false);

        expect(File::get(
            path: base_path("$configPath/{$class}Factory.php")))->toContain($configNamespace);

    })->with('classes');
});

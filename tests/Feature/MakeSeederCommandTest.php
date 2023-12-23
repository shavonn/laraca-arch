<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeSeederCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:seeder', function () {
    it('should create Seeder class at path from namespace', function (string $class) {
        $this->artisan(
            MakeSeederCommand::class,
            ['name' => $class],
        );

        $configPath = getDatabasePath('laraca.seeder.path');
        $filePath = base_path("$configPath/{$class}.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Seeder class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeSeederCommand::class,
            ['name' => $class],
        );

        $configPath = getDatabasePath('laraca.seeder.path');
        $configNamespace = fullNamespaceStr(pathToNamespace($configPath), false);

        expect(File::get(
            path: base_path("$configPath/{$class}.php")))->toContain($configNamespace);

    })->with('classes');
});

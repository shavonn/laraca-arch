<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeEnumCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:enum', function () {
    it('should create Enum class at path from namespace', function (string $class) {
        $this->artisan(
            MakeEnumCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.enum.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Enum class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeEnumCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.enum.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.enum.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

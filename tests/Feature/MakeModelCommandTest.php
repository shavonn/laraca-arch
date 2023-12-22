<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeModelCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:model', function () {
    it('should create Model class at path from namespace', function (string $class) {
        $this->artisan(
            MakeModelCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.model.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Model class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeModelCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.model.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.model.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

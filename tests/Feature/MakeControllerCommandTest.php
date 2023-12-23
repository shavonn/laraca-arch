<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeControllerCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:controller', function () {
    it('should create Controller class at path from namespace', function (string $class) {
        $this->artisan(
            MakeControllerCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.controller.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Controller class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeControllerCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.controller.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.controller.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

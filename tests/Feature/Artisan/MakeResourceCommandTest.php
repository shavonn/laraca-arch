<?php

use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeResourceCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:resource', function () {
    it('should create Resource class at path from namespace', function (string $class) {
        $this->artisan(
            MakeResourceCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.resource.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Resource class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeResourceCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.resource.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.resource.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

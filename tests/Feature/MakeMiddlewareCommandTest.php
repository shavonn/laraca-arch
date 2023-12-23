<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeMiddlewareCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:middleware', function () {
    it('should create Middleware class at path from namespace', function (string $class) {
        $this->artisan(
            MakeMiddlewareCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.middleware.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Middleware class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeMiddlewareCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.middleware.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.middleware.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

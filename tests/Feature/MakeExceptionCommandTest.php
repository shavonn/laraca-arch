<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeExceptionCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:exception', function () {
    it('should create Exception class at path from namespace', function (string $class) {
        $this->artisan(
            MakeExceptionCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.exception.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Exception class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeExceptionCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.exception.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.exception.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

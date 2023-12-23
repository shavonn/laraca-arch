<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeValueCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('make:value', function () {
    it('should create Value class at path from namespace', function (string $class) {
        $this->artisan(
            MakeValueCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.value.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Value class with the defined namespace and class_var', function (string $class) {
        $this->artisan(
            MakeValueCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.value.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.value.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace, Str::camel($class));

    })->with('classes');
});

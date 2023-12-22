<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeScopeCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:scope', function () {
    it('should create Scope class at path from namespace', function (string $class) {
        $this->artisan(
            MakeScopeCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.scope.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Scope class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeScopeCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.scope.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.scope.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

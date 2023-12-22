<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeComponentCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('make:component', function () {
    it('should create Component class at path from namespace', function (string $class) {
        $this->artisan(
            MakeComponentCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.component.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

        $snake_class = Str::snake($class, '-');

        expect(File::exists(
            path: base_path(config('laraca.view.path')."/components/{$snake_class}.blade.php"),
        ))->toBe(true, "File not created at expected path:\n".$result."\n\n");

    })->with('classes');

    it('should create a Component class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeComponentCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.component.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.component.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeProviderCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:provider', function () {
    it('should create Provider class at path from namespace', function (string $class) {
        $this->artisan(
            MakeProviderCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.provider.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Provider class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeProviderCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.provider.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.provider.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

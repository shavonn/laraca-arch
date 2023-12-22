<?php

use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeListenerCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:listener', function () {
    it('should create Listener class at path from namespace', function (string $class) {
        $this->artisan(
            MakeListenerCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.listener.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Listener class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeListenerCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.listener.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.listener.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

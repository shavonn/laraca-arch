<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeObserverCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:observer', function () {
    it('should create Observer class at path from namespace', function (string $class) {
        $this->artisan(
            MakeObserverCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.observer.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Observer class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeObserverCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.observer.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.observer.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

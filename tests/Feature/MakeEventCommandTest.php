<?php

use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeEventCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:event', function () {
    it('should create Event class at path from namespace', function (string $class) {
        $this->artisan(
            MakeEventCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.event.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Event class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeEventCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.event.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.event.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

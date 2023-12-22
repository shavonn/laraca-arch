<?php

use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeCommandCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:command', function () {
    it('should create Command class at path from namespace', function (string $class) {
        $this->artisan(
            MakeCommandCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.command.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Command class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeCommandCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.command.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.command.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

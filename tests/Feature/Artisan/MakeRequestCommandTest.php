<?php

use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeRequestCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:request', function () {
    it('should create Request class at path from namespace', function (string $class) {
        $this->artisan(
            MakeRequestCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.request.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Request class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeRequestCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.request.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.request.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

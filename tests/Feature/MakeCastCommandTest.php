<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeCastCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:cast', function () {
    it('should create Cast class at path from namespace', function (string $class) {
        $this->artisan(
            MakeCastCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.cast.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Cast class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeCastCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.cast.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.cast.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

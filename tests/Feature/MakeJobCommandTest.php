<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeJobCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:job', function () {
    it('should create Job class at path from namespace', function (string $class) {
        $this->artisan(
            MakeJobCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.job.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Job class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeJobCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.job.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.job.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

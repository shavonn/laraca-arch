<?php

use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakePolicyCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:policy', function () {
    it('should create Policy class at path from namespace', function (string $class) {
        $this->artisan(
            MakePolicyCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.policy.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Policy class with the defined namespace', function (string $class) {
        $this->artisan(
            MakePolicyCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.policy.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.policy.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

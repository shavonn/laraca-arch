<?php

use HandsomeBrown\Laraca\Foundation\Console\Artisan\MakeChannelCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:channel', function () {
    it('should create Channel class at path from namespace', function (string $class) {
        $this->artisan(
            MakeChannelCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.channel.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Channel class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeChannelCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.channel.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.channel.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

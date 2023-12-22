<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeNotificationCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:notification', function () {
    it('should create Notification class at path from namespace', function (string $class) {
        $this->artisan(
            MakeNotificationCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.notification.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Notification class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeNotificationCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.notification.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.notification.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

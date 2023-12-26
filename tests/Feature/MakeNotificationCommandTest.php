<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:notification', function () {
    it('should create Notification class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.notification.path', 'Test/Notifications');
        $this->artisan('make:notification',
            ['name' => $class]);

        $configPath = assemblePath('notification');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Notifications');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

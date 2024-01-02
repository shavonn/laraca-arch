<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:notification', function () {
    it('should create Notification class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');
        $this->artisan('make:notification',
            ['name' => $class]);

        $configPath = assembleFullPath('notification');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Notifications');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:notification', function () {
    it('should create Notification class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');

        artisan('make:notification', ['name' => $class]);

        $notificationPath = app_path("Test/Notifications/$class.php");

        expect($notificationPath)->toBeFile();

        expect(File::get($notificationPath))->toContain(
            'namespace App\Test\Notifications;',
            "class $class",
        );
    })->with('classes');
});

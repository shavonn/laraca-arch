<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:notification', function () {
    it('should create Notification class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');

        artisan('make:notification', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $notificationPath = app_path("Test/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            'namespace App\Test\Notifications;',
            "class $class",
        );
    })->with('classes');
});

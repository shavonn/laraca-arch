<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:notification', function () {
    it('should create Notification and test in config path', function (string $class) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');

        artisan('make:notification', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $notificationPath = app_path("Test/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            'namespace App\Test\Notifications;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $notificationTestPath = base_path("tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            'namespace Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Notification and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');

        artisan('make:notification', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $notificationPath = app_path("Domains/$domain/Test/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            "namespace App\Domains\\$domain\Test\Notifications;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $notificationTestPath = app_path("Domains/$domain/tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Notification and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');

        artisan('make:notification', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $notificationPath = app_path("Services/$service/Test/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            "namespace App\Services\\$service\Test\Notifications;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $notificationTestPath = app_path("Services/$service/tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Notification and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');

        artisan('make:notification', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $notificationPath = app_path("Domains/$domain/Services/$service/Test/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Notifications;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $notificationTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

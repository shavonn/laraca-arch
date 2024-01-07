<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:notification', function () {
    it('should create Notification and test in config path', function (string $class) {
        Config::set('laraca.struct.notification.path', 'Test/Notifications');
        Config::set('laraca.struct.test.path', 'Test/tests');

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
        $notificationTestPath = base_path("Test/tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            'namespace Test\Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Notification and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:notification', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $notificationPath = app_path("Test/Domains/$domain/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            "namespace App\Test\Domains\\$domain\Notifications;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $notificationTestPath = app_path("Test/Domains/$domain/tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Notification and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:notification', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $notificationPath = app_path("Test/Services/$service/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            "namespace App\Test\Services\\$service\Notifications;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $notificationTestPath = app_path("Test/Services/$service/tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Notification and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:notification', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $notificationPath = app_path("Test/Domains/$domain/Services/$service/Notifications/$class.php");

        expect($notificationPath)
            ->toBeFile("File not created at expected path:\n$notificationPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Notifications;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $notificationTestPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($notificationTestPath)
            ->toBeFile("File not created at expected path:\n$notificationTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($notificationTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

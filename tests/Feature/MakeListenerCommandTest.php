<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:listener', function () {
    it('should create Listener and test in config path', function (string $class) {
        Config::set('laraca.struct.listener.path', 'Test/Listeners');
        Config::set('laraca.struct.test.path', 'test/tests');

        artisan('make:listener', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $listenerPath = app_path("Test/Listeners/$class.php");

        expect($listenerPath)
            ->toBeFile("File not created at expected path:\n$listenerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerPath))->toContain(
            'namespace App\Test\Listeners;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $listenerTestPath = base_path("test/tests/Feature/$classTest.php");

        expect($listenerTestPath)
            ->toBeFile("File not created at expected path:\n$listenerTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerTestPath))->toContain(
            'namespace Test\Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Listener and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:listener', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $listenerPath = app_path("Test/Domains/$domain/Listeners/$class.php");

        expect($listenerPath)
            ->toBeFile("File not created at expected path:\n$listenerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerPath))->toContain(
            "namespace App\Test\Domains\\$domain\Listeners;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $listenerTestPath = app_path("Test/Domains/$domain/tests/Feature/$classTest.php");

        expect($listenerTestPath)
            ->toBeFile("File not created at expected path:\n$listenerTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Listener and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:listener', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $listenerPath = app_path("Test/Services/$service/Listeners/$class.php");

        expect($listenerPath)
            ->toBeFile("File not created at expected path:\n$listenerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerPath))->toContain(
            "namespace App\Test\Services\\$service\Listeners;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $listenerTestPath = app_path("Test/Services/$service/tests/Feature/$classTest.php");

        expect($listenerTestPath)
            ->toBeFile("File not created at expected path:\n$listenerTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerTestPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Listener and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:listener', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $listenerPath = app_path("Test/Domains/$domain/Services/$service/Listeners/$class.php");

        expect($listenerPath)
            ->toBeFile("File not created at expected path:\n$listenerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Listeners;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $listenerTestPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($listenerTestPath)
            ->toBeFile("File not created at expected path:\n$listenerTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

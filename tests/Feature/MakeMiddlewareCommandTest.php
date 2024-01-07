<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:middleware', function () {
    it('should create Middleware and test in config path', function (string $class) {
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');
        Config::set('laraca.struct.test.path', 'Test/tests');

        artisan('make:middleware', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $middlewarePath = app_path("Test/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            'namespace App\Test\Http\Middleware;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $middlewareTestPath = base_path("Test/tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            'namespace Test\Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Middleware and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:middleware', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $middlewarePath = app_path("Test/Domains/$domain/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            "namespace App\Test\Domains\\$domain\Http\Middleware;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $middlewareTestPath = app_path("Test/Domains/$domain/tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Middleware and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:middleware', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $middlewarePath = app_path("Test/Services/$service/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            "namespace App\Test\Services\\$service\Http\Middleware;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $middlewareTestPath = app_path("Test/Services/$service/tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Middleware and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:middleware', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $middlewarePath = app_path("Test/Domains/$domain/Services/$service/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Http\Middleware;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $middlewareTestPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

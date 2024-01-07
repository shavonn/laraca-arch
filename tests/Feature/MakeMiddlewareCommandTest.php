<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:middleware', function () {
    it('should create Middleware and test in config path', function (string $class) {
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');

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
        $middlewareTestPath = base_path("tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            'namespace Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Middleware and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');

        artisan('make:middleware', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $middlewarePath = app_path("Domains/$domain/Test/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            "namespace App\Domains\\$domain\Test\Http\Middleware;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $middlewareTestPath = app_path("Domains/$domain/tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Middleware and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');

        artisan('make:middleware', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $middlewarePath = app_path("Services/$service/Test/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            "namespace App\Services\\$service\Test\Http\Middleware;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $middlewareTestPath = app_path("Services/$service/tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Middleware and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');

        artisan('make:middleware', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $middlewarePath = app_path("Domains/$domain/Services/$service/Test/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Http\Middleware;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $middlewareTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($middlewareTestPath)
            ->toBeFile("File not created at expected path:\n$middlewareTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewareTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

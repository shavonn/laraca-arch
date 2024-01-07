<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:view', function () {
    it('should create View and test in config path', function (string $class) {
        Config::set('laraca.struct.view.path', 'test/resources/views');
        Config::set('laraca.struct.test.path', 'Test/tests');

        artisan('make:view', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $viewPath = base_path("test/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $class = strtolower($class);
        $classTest = getName($class)->finish('Test');
        $viewTestPath = base_path("Test/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain('namespace Test\Tests\Feature\View;');
    })->with('classes');

    it('should create View and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:view', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $domain = getName($domain);
        $viewPath = app_path("Test/Domains/$domain/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $class = strtolower($class);
        $classTest = getName($class)->finish('Test');
        $viewTestPath = app_path("Test/Domains/$domain/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature\View;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create View and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:view', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $service = getName($service);
        $viewPath = app_path("Test/Services/$service/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $class = strtolower($class);
        $classTest = getName($class)->finish('Test');
        $viewTestPath = app_path("Test/Services/$service/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature\View;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create View and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:view', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $service = getName($service);
        $domain = getName($domain);

        $viewPath = app_path("Test/Domains/$domain/Services/$service/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $class = strtolower($class);
        $classTest = getName($class)->finish('Test');
        $viewTestPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature\View;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

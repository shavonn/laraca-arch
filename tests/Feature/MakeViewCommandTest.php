<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:view', function () {
    it('should create View and test in config path', function (string $class) {
        Config::set('laraca.struct.view.path', 'test/resources/views');
        Config::set('laraca.struct.test.path', 'test/tests');

        artisan('make:view', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $viewPath = base_path("test/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $classTest = getName($class)->finish('Test');
        $viewTestPath = base_path("test/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain('namespace Test\Tests\Feature\View;');
    })->with('classes');

    it('should create View and test in Laravel config path when view not set in laraca config', function (string $class) {
        Config::offsetUnset('view');

        artisan('make:view', ['name' => $class]);
        $output = Artisan::output();

        $viewPath = base_path("resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $classTest = getName($class)->finish('Test');
        $viewTestPath = base_path("tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain('namespace Tests\Feature\View;');
    })->with('classes');

    it('should create View and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.view.path', 'resources/views');

        artisan('make:view', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $domain = getName($domain);
        $viewPath = app_path("Domains/$domain/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $class = strtolower($class);
        $classTest = getName($class)->finish('Test');
        $viewTestPath = app_path("Domains/$domain/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature\View;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create View and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.view.path', 'resources/views');

        artisan('make:view', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $service = getName($service);
        $viewPath = app_path("Services/$service/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $class = strtolower($class);
        $classTest = getName($class)->finish('Test');
        $viewTestPath = app_path("Services/$service/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature\View;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create View and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.view.path', 'resources/views');
        Config::set('laraca.struct.component.path', 'Test/View');

        artisan('make:view', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $service = getName($service);
        $domain = getName($domain);

        $viewPath = app_path("Domains/$domain/Services/$service/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');

        $class = strtolower($class);
        $classTest = getName($class)->finish('Test');
        $viewTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/View/$classTest.php");

        expect($viewTestPath)
            ->toBeFile("File not created at expected path:\n$viewTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature\View;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

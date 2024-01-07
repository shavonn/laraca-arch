<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:component', function () {
    it('should create Component and test in config path', function (string $class) {
        Config::set('laraca.struct.component.path', 'Test/View/Components');
        Config::set('laraca.struct.test.path', 'Test/tests');
        Config::set('laraca.struct.view.path', 'test/resources/views');

        artisan('make:component', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $componentPath = app_path("Test/View/Components/$class.php");

        expect($componentPath)
            ->toBeFile("File not created at expected path:\n$componentPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentPath))->toContain(
            'namespace App\Test\View\Components;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $componentTestPath = base_path("Test/tests/Feature/$classTest.php");

        expect($componentTestPath)
            ->toBeFile("File not created at expected path:\n$componentTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentTestPath))->toContain(
            'namespace Test\Tests\Feature;',
            "class $classTest",
        );

        $viewName = $class->kebab();
        $viewPath = base_path("test/resources/views/components/{$viewName}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');
    })->with('classes');

    it('should create Component and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:component', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $componentPath = app_path("Test/Domains/$domain/View/Components/$class.php");

        expect($componentPath)
            ->toBeFile("File not created at expected path:\n$componentPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentPath))->toContain(
            "namespace App\Test\Domains\\$domain\View\Components;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $componentTestPath = app_path("Test/Domains/$domain/tests/Feature/$classTest.php");

        expect($componentTestPath)
            ->toBeFile("File not created at expected path:\n$componentTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Component and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:component', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $componentPath = app_path("Test/Services/$service/View/Components/$class.php");

        expect($componentPath)
            ->toBeFile("File not created at expected path:\n$componentPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentPath))->toContain(
            "namespace App\Test\Services\\$service\View\Components;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $componentTestPath = app_path("Test/Services/$service/tests/Feature/$classTest.php");

        expect($componentTestPath)
            ->toBeFile("File not created at expected path:\n$componentTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentTestPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Component and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:component', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $componentPath = app_path("Test/Domains/$domain/Services/$service/View/Components/$class.php");

        expect($componentPath)
            ->toBeFile("File not created at expected path:\n$componentPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\View\Components;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $componentTestPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($componentTestPath)
            ->toBeFile("File not created at expected path:\n$componentTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($componentTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

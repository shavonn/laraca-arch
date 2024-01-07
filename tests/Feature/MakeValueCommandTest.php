<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:value', function () {
    it('should create Value and test in config path', function (string $class) {
        Config::set('laraca.struct.value.path', 'Test/Data/Values');
        Config::set('laraca.struct.test.path', 'Test/tests');

        artisan('make:value', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $valuePath = app_path("Test/Data/Values/$class.php");

        expect($valuePath)
            ->toBeFile("File not created at expected path:\n$valuePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valuePath))->toContain(
            'namespace App\Test\Data\Values;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $valueTestPath = base_path("Test/tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            'namespace Test\Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Value and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:value', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $valuePath = app_path("Test/Domains/$domain/Data/Values/$class.php");

        expect($valuePath)
            ->toBeFile("File not created at expected path:\n$valuePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valuePath))->toContain(
            "namespace App\Test\Domains\\$domain\Data\Values;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $valueTestPath = app_path("Test/Domains/$domain/tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Value and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:value', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $valuePath = app_path("Test/Services/$service/Data/Values/$class.php");

        expect($valuePath)
            ->toBeFile("File not created at expected path:\n$valuePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valuePath))->toContain(
            "namespace App\Test\Services\\$service\Data\Values;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $valueTestPath = app_path("Test/Services/$service/tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Value and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:value', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $valuePath = app_path("Test/Domains/$domain/Services/$service/Data/Values/$class.php");

        expect($valuePath)
            ->toBeFile("File not created at expected path:\n$valuePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valuePath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Data\Values;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $valueTestPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

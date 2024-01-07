<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:value', function () {
    it('should create Value and test in config path', function (string $class) {
        Config::set('laraca.struct.value.path', 'Test/Data/Values');

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
        $valueTestPath = base_path("tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            'namespace Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Value and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.value.path', 'Test/Data/Values');

        artisan('make:value', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $valuePath = app_path("Domains/$domain/Test/Data/Values/$class.php");

        expect($valuePath)
            ->toBeFile("File not created at expected path:\n$valuePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valuePath))->toContain(
            "namespace App\Domains\\$domain\Test\Data\Values;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $valueTestPath = app_path("Domains/$domain/tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Value and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.value.path', 'Test/Data/Values');

        artisan('make:value', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $valuePath = app_path("Services/$service/Test/Data/Values/$class.php");

        expect($valuePath)
            ->toBeFile("File not created at expected path:\n$valuePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valuePath))->toContain(
            "namespace App\Services\\$service\Test\Data\Values;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $valueTestPath = app_path("Services/$service/tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Value and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.value.path', 'Test/Data/Values');

        artisan('make:value', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $valuePath = app_path("Domains/$domain/Services/$service/Test/Data/Values/$class.php");

        expect($valuePath)
            ->toBeFile("File not created at expected path:\n$valuePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valuePath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Data\Values;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $valueTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($valueTestPath)
            ->toBeFile("File not created at expected path:\n$valueTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($valueTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

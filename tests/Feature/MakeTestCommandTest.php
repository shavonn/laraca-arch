<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:test', function () {
    it('should create Test in config path', function (string $class) {
        Config::set('laraca.struct.test.path', 'Test/tests');

        artisan('make:test', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $testPath = base_path("Test/tests/Feature/$class.php");

        expect($testPath)
            ->toBeFile("File not created at expected path:\n$testPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($testPath))->toContain(
            'namespace Test\Tests\Feature;',
            "class $class",
        );
    })->with('classes');

    it('sshould create Test in config path with unit option', function (string $class) {
        Config::set('laraca.struct.test.path', 'Test/tests');

        artisan('make:test', ['name' => $class, '--unit' => true]);
        $output = Artisan::output();

        $class = getName($class);

        $testPath = base_path("Test/tests/Unit/$class.php");

        expect($testPath)
            ->toBeFile("File not created at expected path:\n$testPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($testPath))->toContain(
            'namespace Test\Tests\Unit;',
            "class $class",
        );
    })->with('classes');

    it('should create Test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:test', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $testPath = app_path("Test/Domains/$domain/tests/Feature/$class.php");

        expect($testPath)
            ->toBeFile("File not created at expected path:\n$testPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($testPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:test', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $testPath = app_path("Test/Services/$service/tests/Feature/$class.php");

        expect($testPath)
            ->toBeFile("File not created at expected path:\n$testPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($testPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:test', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $testPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/$class.php");

        expect($testPath)
            ->toBeFile("File not created at expected path:\n$testPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($testPath))->toContain(

            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:factory', function () {
    it('should create Factory in config path', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('make:factory', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $factoryPath = base_path("test/database/factories/{$class}Factory.php");

        expect($factoryPath)
            ->toBeFile("File not created at expected path:\n$factoryPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($factoryPath))->toContain(
            'namespace Test\Database\Factories;',
            "class $class",
        );
    })->with('classes');

    it('should create Factory in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:factory', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $factoryPath = app_path("Test/Domains/$domain/database/factories/{$class}Factory.php");

        expect($factoryPath)
            ->toBeFile("File not created at expected path:\n$factoryPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($factoryPath))->toContain(
            "namespace App\Test\Domains\\$domain\Database\Factories;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Factory in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:factory', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $factoryPath = app_path("Test/Services/$service/database/factories/{$class}Factory.php");

        expect($factoryPath)
            ->toBeFile("File not created at expected path:\n$factoryPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($factoryPath))->toContain(
            "namespace App\Test\Services\\$service\Database\Factories;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Factory in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:factory', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $factoryPath = app_path("Test/Domains/$domain/Services/$service/database/factories/{$class}Factory.php");

        expect($factoryPath)
            ->toBeFile("File not created at expected path:\n$factoryPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($factoryPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Database\Factories;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

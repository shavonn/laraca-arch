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
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('make:factory', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $factoryPath = app_path("Domains/$domain/test/database/factories/{$class}Factory.php");

        expect($factoryPath)
            ->toBeFile("File not created at expected path:\n$factoryPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($factoryPath))->toContain(
            "namespace App\Domains\\$domain\Test\Database\Factories;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Factory in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('make:factory', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $factoryPath = app_path("Services/$service/test/database/factories/{$class}Factory.php");

        expect($factoryPath)
            ->toBeFile("File not created at expected path:\n$factoryPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($factoryPath))->toContain(
            "namespace App\Services\\$service\Test\Database\Factories;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Factory in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('make:factory', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $factoryPath = app_path("Domains/$domain/Services/$service/test/database/factories/{$class}Factory.php");

        expect($factoryPath)
            ->toBeFile("File not created at expected path:\n$factoryPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($factoryPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Database\Factories;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

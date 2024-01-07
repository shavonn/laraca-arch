<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:enum', function () {
    it('should create Enum in config path', function (string $class) {
        Config::set('laraca.struct.enum.path', 'Test/Enums');

        artisan('make:enum', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $enumPath = app_path("Test/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            'namespace App\Test\Enums;',
            "enum $class",
        );
    })->with('classes');

    it('should create Enum in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:enum', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $enumPath = app_path("Test/Domains/$domain/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            "namespace App\Test\Domains\\$domain\Enums;",
            "enum $class",
        );
    })->with('classes', 'domains');

    it('should create Enum in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:enum', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $enumPath = app_path("Test/Services/$service/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            "namespace App\Test\Services\\$service\Enums;",
            "enum $class",
        );
    })->with('classes', 'domains');

    it('should create Enum in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:enum', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $enumPath = app_path("Test/Domains/$domain/Services/$service/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Enums;",
            "enum $class",
        );
    })->with('classes', 'domains', 'domains');
});

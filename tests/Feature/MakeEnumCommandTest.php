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
        Config::set('laraca.struct.enum.path', 'Test/Enums');

        artisan('make:enum', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $enumPath = app_path("Domains/$domain/Test/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            "namespace App\Domains\\$domain\Test\Enums;",
            "enum $class",
        );
    })->with('classes', 'domains');

    it('should create Enum in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.enum.path', 'Test/Enums');

        artisan('make:enum', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $enumPath = app_path("Services/$service/Test/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            "namespace App\Services\\$service\Test\Enums;",
            "enum $class",
        );
    })->with('classes', 'domains');

    it('should create Enum in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.enum.path', 'Test/Enums');

        artisan('make:enum', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $enumPath = app_path("Domains/$domain/Services/$service/Test/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Enums;",
            "enum $class",
        );
    })->with('classes', 'domains', 'domains');
});

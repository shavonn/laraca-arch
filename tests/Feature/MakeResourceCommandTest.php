<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:resource', function () {
    it('should create Resource and test in config path', function (string $class) {
        Config::set('laraca.struct.resource.path', 'Test/Http/Resources');

        artisan('make:resource', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $resourcePath = app_path("Test/Http/Resources/$class.php");

        expect($resourcePath)
            ->toBeFile("File not created at expected path:\n$resourcePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($resourcePath))->toContain(
            'namespace App\Test\Http\Resources;',
            "class $class",
        );
    })->with('classes');

    it('should create Resource and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.resource.path', 'Test/Http/Resources');

        artisan('make:resource', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $resourcePath = app_path("Domains/$domain/Test/Http/Resources/$class.php");

        expect($resourcePath)
            ->toBeFile("File not created at expected path:\n$resourcePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($resourcePath))->toContain(
            "namespace App\Domains\\$domain\Test\Http\Resources;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Resource and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.resource.path', 'Test/Http/Resources');

        artisan('make:resource', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $resourcePath = app_path("Services/$service/Test/Http/Resources/$class.php");

        expect($resourcePath)
            ->toBeFile("File not created at expected path:\n$resourcePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($resourcePath))->toContain(
            "namespace App\Services\\$service\Test\Http\Resources;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Resource and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.resource.path', 'Test/Http/Resources');

        artisan('make:resource', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $resourcePath = app_path("Domains/$domain/Services/$service/Test/Http/Resources/$class.php");

        expect($resourcePath)
            ->toBeFile("File not created at expected path:\n$resourcePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($resourcePath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Http\Resources;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

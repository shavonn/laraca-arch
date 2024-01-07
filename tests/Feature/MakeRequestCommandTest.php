<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:request', function () {
    it('should create Request and test in config path', function (string $class) {
        Config::set('laraca.struct.request.path', 'Test/Http/Requests');

        artisan('make:request', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $requestPath = app_path("Test/Http/Requests/$class.php");

        expect($requestPath)
            ->toBeFile("File not created at expected path:\n$requestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($requestPath))->toContain(
            'namespace App\Test\Http\Requests;',
            "class $class",
        );
    })->with('classes');

    it('should create Request and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.request.path', 'Test/Http/Requests');

        artisan('make:request', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $requestPath = app_path("Domains/$domain/Test/Http/Requests/$class.php");

        expect($requestPath)
            ->toBeFile("File not created at expected path:\n$requestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($requestPath))->toContain(
            "namespace App\Domains\\$domain\Test\Http\Requests;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Request and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.request.path', 'Test/Http/Requests');

        artisan('make:request', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $requestPath = app_path("Services/$service/Test/Http/Requests/$class.php");

        expect($requestPath)
            ->toBeFile("File not created at expected path:\n$requestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($requestPath))->toContain(
            "namespace App\Services\\$service\Test\Http\Requests;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Request and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.request.path', 'Test/Http/Requests');

        artisan('make:request', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $requestPath = app_path("Domains/$domain/Services/$service/Test/Http/Requests/$class.php");

        expect($requestPath)
            ->toBeFile("File not created at expected path:\n$requestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($requestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Http\Requests;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

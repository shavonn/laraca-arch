<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:scope', function () {
    it('should create Scope and test in config path', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        artisan('make:scope', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $scopePath = app_path("Test/Data/Models/Scopes/$class.php");

        expect($scopePath)
            ->toBeFile("File not created at expected path:\n$scopePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($scopePath))->toContain(
            'namespace App\Test\Data\Models\Scopes;',
            "class $class",
        );
    })->with('classes');

    it('should create Scope and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:scope', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $scopePath = app_path("Test/Domains/$domain/Data/Models/Scopes/$class.php");

        expect($scopePath)
            ->toBeFile("File not created at expected path:\n$scopePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($scopePath))->toContain(
            "namespace App\Test\Domains\\$domain\Data\Models\Scopes;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Scope and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:scope', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $scopePath = app_path("Test/Services/$service/Data/Models/Scopes/$class.php");

        expect($scopePath)
            ->toBeFile("File not created at expected path:\n$scopePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($scopePath))->toContain(
            "namespace App\Test\Services\\$service\Data\Models\Scopes;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Scope and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:scope', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $scopePath = app_path("Test/Domains/$domain/Services/$service/Data/Models/Scopes/$class.php");

        expect($scopePath)
            ->toBeFile("File not created at expected path:\n$scopePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($scopePath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Data\Models\Scopes;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

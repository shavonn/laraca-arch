<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:provider', function () {
    it('should create Provider and test in config path', function (string $class) {
        Config::set('laraca.struct.provider.path', 'Test/Providers');

        artisan('make:provider', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $providerPath = app_path("Test/Providers/$class.php");

        expect($providerPath)
            ->toBeFile("File not created at expected path:\n$providerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($providerPath))->toContain(
            'namespace App\Test\Providers;',
            "class $class",
        );
    })->with('classes');

    it('should create Provider and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.provider.path', 'Test/Providers');

        artisan('make:provider', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $providerPath = app_path("Domains/$domain/Test/Providers/$class.php");

        expect($providerPath)
            ->toBeFile("File not created at expected path:\n$providerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($providerPath))->toContain(
            "namespace App\Domains\\$domain\Test\Providers;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Provider and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.provider.path', 'Test/Providers');

        artisan('make:provider', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $providerPath = app_path("Services/$service/Test/Providers/$class.php");

        expect($providerPath)
            ->toBeFile("File not created at expected path:\n$providerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($providerPath))->toContain(
            "namespace App\Services\\$service\Test\Providers;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Provider and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.provider.path', 'Test/Providers');

        artisan('make:provider', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $providerPath = app_path("Domains/$domain/Services/$service/Test/Providers/$class.php");

        expect($providerPath)
            ->toBeFile("File not created at expected path:\n$providerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($providerPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Providers;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

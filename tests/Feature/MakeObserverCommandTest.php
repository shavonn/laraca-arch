<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:observer', function () {
    it('should create Observer and test in config path', function (string $class) {
        Config::set('laraca.struct.observer.path', 'Test/Data/Observers');

        artisan('make:observer', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $observerPath = app_path("Test/Data/Observers/$class.php");

        expect($observerPath)
            ->toBeFile("File not created at expected path:\n$observerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($observerPath))->toContain(
            'namespace App\Test\Data\Observers;',
            "class $class",
        );
    })->with('classes');

    it('should create Observer and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.observer.path', 'Test/Data/Observers');

        artisan('make:observer', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $observerPath = app_path("Domains/$domain/Test/Data/Observers/$class.php");

        expect($observerPath)
            ->toBeFile("File not created at expected path:\n$observerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($observerPath))->toContain(
            "namespace App\Domains\\$domain\Test\Data\Observers;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Observer and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.observer.path', 'Test/Data/Observers');

        artisan('make:observer', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $observerPath = app_path("Services/$service/Test/Data/Observers/$class.php");

        expect($observerPath)
            ->toBeFile("File not created at expected path:\n$observerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($observerPath))->toContain(
            "namespace App\Services\\$service\Test\Data\Observers;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Observer and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.observer.path', 'Test/Data/Observers');

        artisan('make:observer', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $observerPath = app_path("Domains/$domain/Services/$service/Test/Data/Observers/$class.php");

        expect($observerPath)
            ->toBeFile("File not created at expected path:\n$observerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($observerPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Data\Observers;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

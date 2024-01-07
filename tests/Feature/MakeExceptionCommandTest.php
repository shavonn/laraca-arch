<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:exception', function () {
    it('should create Exception in config path', function (string $class) {
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');

        artisan('make:exception', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $exceptionPath = app_path("Test/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            'namespace App\Test\Exceptions;',
            "class $class",
        );
    })->with('classes');

    it('should create Exception in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');

        artisan('make:exception', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $exceptionPath = app_path("Domains/$domain/Test/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            "namespace App\Domains\\$domain\Test\Exceptions;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Exception in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');

        artisan('make:exception', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $exceptionPath = app_path("Services/$service/Test/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            "namespace App\Services\\$service\Test\Exceptions;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Exception in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');

        artisan('make:exception', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $exceptionPath = app_path("Domains/$domain/Services/$service/Test/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Exceptions;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

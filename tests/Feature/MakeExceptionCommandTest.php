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
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:exception', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $exceptionPath = app_path("Test/Domains/$domain/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            "namespace App\Test\Domains\\$domain\Exceptions;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Exception in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:exception', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $exceptionPath = app_path("Test/Services/$service/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            "namespace App\Test\Services\\$service\Exceptions;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Exception in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:exception', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $exceptionPath = app_path("Test/Domains/$domain/Services/$service/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Exceptions;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

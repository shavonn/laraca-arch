<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:rule', function () {
    it('should create Rule and test in config path', function (string $class) {
        Config::set('laraca.struct.rule.path', 'Test/Rules');

        artisan('make:rule', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $rulePath = app_path("Test/Rules/$class.php");

        expect($rulePath)
            ->toBeFile("File not created at expected path:\n$rulePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($rulePath))->toContain(
            'namespace App\Test\Rules;',
            "class $class",
        );
    })->with('classes');

    it('should create Rule and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.rule.path', 'Test/Rules');

        artisan('make:rule', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $rulePath = app_path("Domains/$domain/Test/Rules/$class.php");

        expect($rulePath)
            ->toBeFile("File not created at expected path:\n$rulePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($rulePath))->toContain(
            "namespace App\Domains\\$domain\Test\Rules;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Rule and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.rule.path', 'Test/Rules');

        artisan('make:rule', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $rulePath = app_path("Services/$service/Test/Rules/$class.php");

        expect($rulePath)
            ->toBeFile("File not created at expected path:\n$rulePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($rulePath))->toContain(
            "namespace App\Services\\$service\Test\Rules;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Rule and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.rule.path', 'Test/Rules');

        artisan('make:rule', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $rulePath = app_path("Domains/$domain/Services/$service/Test/Rules/$class.php");

        expect($rulePath)
            ->toBeFile("File not created at expected path:\n$rulePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($rulePath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Rules;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

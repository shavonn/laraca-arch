<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:policy', function () {
    it('should create Policy and test in config path', function (string $class) {
        Config::set('laraca.struct.policy.path', 'Test/Policies');

        artisan('make:policy', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $policyPath = app_path("Test/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            'namespace App\Test\Policies;',
            "class $class",
        );
    })->with('classes');

    it('should create Policy and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:policy', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $policyPath = app_path("Test/Domains/$domain/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            "namespace App\Test\Domains\\$domain\Policies;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Policy and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:policy', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $policyPath = app_path("Test/Services/$service/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            "namespace App\Test\Services\\$service\Policies;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Policy and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:policy', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $policyPath = app_path("Test/Domains/$domain/Services/$service/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Policies;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

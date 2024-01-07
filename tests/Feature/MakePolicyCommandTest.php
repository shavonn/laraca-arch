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
        Config::set('laraca.struct.policy.path', 'Test/Policies');

        artisan('make:policy', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $policyPath = app_path("Domains/$domain/Test/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            "namespace App\Domains\\$domain\Test\Policies;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Policy and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.policy.path', 'Test/Policies');

        artisan('make:policy', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $policyPath = app_path("Services/$service/Test/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            "namespace App\Services\\$service\Test\Policies;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Policy and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.policy.path', 'Test/Policies');

        artisan('make:policy', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $policyPath = app_path("Domains/$domain/Services/$service/Test/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Policies;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:command', function () {
    it('should create Command and test in config path', function (string $class) {
        Config::set('laraca.struct.command.path', 'Test/Console/Commands');
        Config::set('laraca.struct.test.path', 'Test/tests');

        artisan('make:command', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $commandPath = app_path("Test/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            'namespace App\Test\Console\Commands;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $commandTestPath = base_path("Test/tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            'namespace Test\Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Command and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:command', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $commandPath = app_path("Test/Domains/$domain/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            "namespace App\Test\Domains\\$domain\Console\Commands;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $commandTestPath = app_path("Test/Domains/$domain/tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Command and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:command', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $commandPath = app_path("Test/Services/$service/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            "namespace App\Test\Services\\$service\Console\Commands;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $commandTestPath = app_path("Test/Services/$service/tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            "namespace App\Test\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Command and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:command', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $commandPath = app_path("Test/Domains/$domain/Services/$service/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Console\Commands;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $commandTestPath = app_path("Test/Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

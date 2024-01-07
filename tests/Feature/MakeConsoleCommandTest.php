<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:command', function () {
    it('should create Command and test in config path', function (string $class) {
        Config::set('laraca.struct.command.path', 'Test/Console/Commands');

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
        $commandTestPath = base_path("tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            'namespace Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Command and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.command.path', 'Test/Console/Commands');

        artisan('make:command', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $commandPath = app_path("Domains/$domain/Test/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            "namespace App\Domains\\$domain\Test\Console\Commands;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $commandTestPath = app_path("Domains/$domain/tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Command and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.command.path', 'Test/Console/Commands');

        artisan('make:command', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $commandPath = app_path("Services/$service/Test/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            "namespace App\Services\\$service\Test\Console\Commands;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $commandTestPath = app_path("Services/$service/tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Command and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.command.path', 'Test/Console/Commands');

        artisan('make:command', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $commandPath = app_path("Domains/$domain/Services/$service/Test/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Console\Commands;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $commandTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($commandTestPath)
            ->toBeFile("File not created at expected path:\n$commandTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});
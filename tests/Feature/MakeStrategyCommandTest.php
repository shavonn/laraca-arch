<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:strategy', function () {
    it('should create Strategy and test in config path', function (string $class) {
        Config::set('laraca.struct.strategy.path', 'Test/Strategy');

        artisan('make:strategy', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);

        $strategyPath = app_path("Test/Strategy/Type{$class}Strategy.php");
        $interfacePath = app_path("Test/Strategy/{$class}Strategy.php");

        expect($strategyPath)
            ->toBeFile("File not created at expected path:\n$strategyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyPath))->toContain(
            'namespace App\Test\Strategy;',
            "class Type{$class}Strategy",
        );

        expect($interfacePath)
            ->toBeFile("File not created at expected path:\n$interfacePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($interfacePath))->toContain(
            'namespace App\Test\Strategy;',
            "interface {$class}Strategy",
        );

        $classTest = getName($class)->start('Type')->finish('StrategyTest');
        $strategyTestPath = base_path("tests/Feature/$classTest.php");

        expect($strategyTestPath)
            ->toBeFile("File not created at expected path:\n$strategyTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyTestPath))->toContain(
            'namespace Tests\Feature',
            "class $classTest",
        );
    })->with('classes');

    it('should create Strategy and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.strategy.path', 'Test/Strategy');

        artisan('make:strategy', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);

        $strategyPath = app_path("Domains/$domain/Test/Strategy/Type{$class}Strategy.php");
        $interfacePath = app_path("Domains/$domain/Test/Strategy/{$class}Strategy.php");

        expect($strategyPath)
            ->toBeFile("File not created at expected path:\n$strategyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyPath))->toContain(
            "namespace App\Domains\\$domain\Test\Strategy;",
            "class Type{$class}Strategy",
        );

        expect($interfacePath)
            ->toBeFile("File not created at expected path:\n$interfacePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($interfacePath))->toContain(
            "namespace App\Domains\\$domain\Test\Strategy;",
            "interface {$class}Strategy",
        );

        $classTest = getName($class)->start('Type')->finish('StrategyTest');
        $strategyTestPath = app_path("Domains/$domain/tests/Feature/$classTest.php");

        expect($strategyTestPath)
            ->toBeFile("File not created at expected path:\n$strategyTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Strategy and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.strategy.path', 'Test/Strategy');

        artisan('make:strategy', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);

        $strategyPath = app_path("Services/$service/Test/Strategy/Type{$class}Strategy.php");
        $interfacePath = app_path("Services/$service/Test/Strategy/{$class}Strategy.php");

        expect($strategyPath)
            ->toBeFile("File not created at expected path:\n$strategyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyPath))->toContain(
            "namespace App\Services\\$service\Test\Strategy;",
            "class Type{$class}Strategy",
        );

        expect($interfacePath)
            ->toBeFile("File not created at expected path:\n$interfacePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($interfacePath))->toContain(
            "namespace App\Services\\$service\Test\Strategy;",
            "interface {$class}Strategy",
        );

        $classTest = getName($class)->start('Type')->finish('StrategyTest');
        $strategyTestPath = app_path("Services/$service/tests/Feature/$classTest.php");

        expect($strategyTestPath)
            ->toBeFile("File not created at expected path:\n$strategyTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Strategy and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.strategy.path', 'Test/Strategy');

        artisan('make:strategy', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $strategyPath = app_path("Domains/$domain/Services/$service/Test/Strategy/Type{$class}Strategy.php");
        $interfacePath = app_path("Domains/$domain/Services/$service/Test/Strategy/{$class}Strategy.php");

        expect($strategyPath)
            ->toBeFile("File not created at expected path:\n$strategyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Strategy;",
            "class Type{$class}Strategy",
        );

        expect($interfacePath)
            ->toBeFile("File not created at expected path:\n$interfacePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($interfacePath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Strategy;",
            "interface {$class}Strategy",
        );

        $classTest = getName($class)->start('Type')->finish('StrategyTest');
        $strategyTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($strategyTestPath)
            ->toBeFile("File not created at expected path:\n$strategyTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($strategyTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');

    it('should not allow an existing strategy to be created', function (string $class) {
        Config::set('laraca.struct.strategy.path', 'Test/Strategy');

        artisan('make:strategy', ['name' => $class]);

        artisan('make:strategy', ['name' => $class]);
        $output = Artisan::output();

        expect($output)->toContain('already exists');
    })->with('classes');
});

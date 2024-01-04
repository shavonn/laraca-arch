<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:strategy', function () {
    it('should create strategy interface and concrete class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.strategy.path', 'Test/Strategy');

        artisan('make:strategy', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

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
    })->with('classes');

    it('should not allow an existing strategy to be created', function (string $class) {
        Config::set('laraca.struct.strategy.path', 'Test/Strategy');

        artisan('make:strategy', ['name' => $class]);

        artisan('make:strategy', ['name' => $class]);

        $output = Artisan::output();
        expect($output)->toContain('already exists');
    })->with('classes');
});

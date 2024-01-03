<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:service', function () {
    it('should create Service class and interface with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.service.path', 'Test/Services');

        artisan('make:service', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $servicePath = app_path("Test/Services/{$class}Service.php");
        $interfacePath = app_path("Test/Services/{$class}ServiceInterface.php");

        expect($servicePath)
            ->toBeFile("File not created at expected path:\n$servicePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($servicePath))->toContain(
            'namespace App\Test\Services;',
            "class $class",
        );

        expect($interfacePath)
            ->toBeFile("File not created at expected path:\n$interfacePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($interfacePath))->toContain(
            'namespace App\Test\Services;',
            "interface $class",
        );
    })->with('classes');

    it('should not allow the same service to be created twice', function (string $class) {
        Config::set('laraca.struct.service.path', 'Test/Services');

        artisan('make:service', ['name' => $class]);

        artisan('make:service', ['name' => $class]);

        $output = Artisan::output();
        expect($output)->toContain('already exists');
    })->with('classes');
});

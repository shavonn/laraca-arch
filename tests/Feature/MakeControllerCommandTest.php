<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:controller', function () {
    it('should create Controller class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.controller.path', 'Test/Http/Controllers');

        artisan('make:controller', ['name' => $class]);

        $controllerPath = app_path("Test/Http/Controllers/$class.php");

        expect($controllerPath)->toBeFile();

        expect(File::get($controllerPath))->toContain(
            'namespace App\Test\Http\Controllers;',
            "class $class",
        );
    })->with('classes');
});

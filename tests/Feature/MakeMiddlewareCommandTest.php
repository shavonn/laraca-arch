<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:middleware', function () {
    it('should create Middleware class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');

        artisan('make:middleware', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $middlewarePath = app_path("Test/Http/Middleware/$class.php");

        expect($middlewarePath)
            ->toBeFile("File not created at expected path:\n$middlewarePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($middlewarePath))->toContain(
            'namespace App\Test\Http\Middleware;',
            "class $class",
        );
    })->with('classes');
});

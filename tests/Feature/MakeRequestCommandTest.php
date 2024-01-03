<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:request', function () {
    it('should create Request class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.request.path', 'Test/Http/Requests');

        artisan('make:request', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $requestPath = app_path("Test/Http/Requests/$class.php");

        expect($requestPath)
            ->toBeFile("File not created at expected path:\n$requestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($requestPath))->toContain(
            'namespace App\Test\Http\Requests;',
            "class $class",
        );
    })->with('classes');
});

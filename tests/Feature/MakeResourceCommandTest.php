<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:resource', function () {
    it('should create Resource class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.resource.path', 'Test/Http/Resources');

        artisan('make:resource', ['name' => $class]);

        $resourcePath = app_path("Test/Http/Resources/$class.php");

        expect($resourcePath)->toBeFile();

        expect(File::get($resourcePath))->toContain(
            'namespace App\Test\Http\Resources;',
            "class $class",
        );
    })->with('classes');
});

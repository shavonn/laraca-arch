<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:scope', function () {
    it('should create Scope class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        artisan('make:scope', ['name' => $class]);

        $scopePath = app_path("Test/Data/Models/Scopes/$class.php");

        expect($scopePath)->toBeFile();

        expect(File::get($scopePath))->toContain(
            'namespace App\Test\Data\Models\Scopes;',
            "class $class",
        );
    })->with('classes');
});

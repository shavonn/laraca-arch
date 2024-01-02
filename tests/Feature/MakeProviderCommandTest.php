<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:provider', function () {
    it('should create Provider class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.provider.path', 'Test/Providers');

        artisan('make:provider', ['name' => $class]);

        $providerPath = app_path("Test/Providers/$class.php");

        expect($providerPath)->toBeFile();

        expect(File::get($providerPath))->toContain(
            'namespace App\Test\Providers;',
            "class $class",
        );
    })->with('classes');
});

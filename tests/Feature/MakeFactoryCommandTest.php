<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:factory', function () {
    it('should create Factory class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('make:factory', ['name' => $class]);

        $factoryPath = base_path("test/database/factories/{$class}Factory.php");

        expect($factoryPath)->toBeFile();

        expect(File::get($factoryPath))->toContain(
            'namespace Test\Database\Factories;',
            "class $class",
        );
    })->with('classes');
});

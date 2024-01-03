<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:value', function () {
    it('should create Value class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.value.path', 'Test/Data/Values');

        artisan('make:value', ['name' => $class]);

        $valuePath = app_path("Test/Data/Values/$class.php");

        expect($valuePath)->toBeFile();

        expect(File::get($valuePath))->toContain(
            'namespace App\Test\Data\Values;',
            "class $class",
        );
    })->with('classes');
});

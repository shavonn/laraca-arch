<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:enum', function () {
    it('should create Enum class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.enum.path', 'Test/Enums');

        artisan('make:enum', ['name' => $class]);

        $enumPath = app_path("Test/Enums/$class.php");

        expect($enumPath)->toBeFile();

        expect(File::get($enumPath))->toContain(
            'namespace App\Test\Enums;',
            "enum $class",
        );
    })->with('classes');
});

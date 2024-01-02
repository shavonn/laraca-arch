<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:exception', function () {
    it('should create Exception class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');

        artisan('make:exception', ['name' => $class]);

        $exceptionPath = app_path("Test/Exceptions/$class.php");

        expect($exceptionPath)->toBeFile();

        expect(File::get($exceptionPath))->toContain(
            'namespace App\Test\Exceptions;',
            "class $class",
        );
    })->with('classes');
});

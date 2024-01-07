<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:exception', function () {
    it('should create Exception class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');

        $class = getName($class);

        artisan('make:exception', ['name' => $class]);
        $output = Artisan::output();

        $exceptionPath = app_path("Test/Exceptions/$class.php");

        expect($exceptionPath)
            ->toBeFile("File not created at expected path:\n$exceptionPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($exceptionPath))->toContain(
            'namespace App\Test\Exceptions;',
            "class $class",
        );
    })->with('classes');
});

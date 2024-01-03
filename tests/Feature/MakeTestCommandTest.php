<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:test', function () {
    it('should create Test class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.test.path', 'test/tests');

        artisan('make:test', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $testPath = base_path("test/tests/Feature/$class.php");

        expect($testPath)
            ->toBeFile("File not created at expected path:\n$testPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($testPath))->toContain(
            'namespace Tests\Feature;',
            "class $class",
        );
    })->with('classes');

    it('should create Test class with namespace and path created from configured vals with unit option', function (string $class) {
        Config::set('laraca.struct.test.path', 'test/tests');

        artisan('make:test', ['name' => $class, '--unit' => true]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $testPath = base_path("test/tests/Unit/$class.php");

        expect($testPath)
            ->toBeFile("File not created at expected path:\n$testPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($testPath))->toContain(
            'namespace Tests\Unit;',
            "class $class",
        );
    })->with('classes');
});

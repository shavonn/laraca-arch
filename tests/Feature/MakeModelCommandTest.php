<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:model', function () {
    it('should create Model and test in config path', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        artisan('make:model', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $modelPath = app_path("Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            'namespace App\Test\Data\Models;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $modelTestPath = base_path("tests/Feature/$classTest.php");

        expect($modelTestPath)
            ->toBeFile("File not created at expected path:\n$modelTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelTestPath))->toContain(
            'namespace Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Model and test in config path with HasUuids trait', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        $class = getName($class);

        artisan('make:model', ['name' => $class, '--uuid' => true]);
        $output = Artisan::output();

        $modelPath = app_path("Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            'namespace App\Test\Data\Models;',
            "class $class",
            'HasUuids',
        );
    })->with('classes');
});

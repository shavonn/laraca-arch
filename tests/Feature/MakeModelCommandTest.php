<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:model', function () {
    it('should create Model class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        $class = ucfirst($class);

        artisan('make:model', ['name' => $class]);
        $output = Artisan::output();

        $modelPath = app_path("Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            'namespace App\Test\Data\Models;',
            "class $class",
        );
    })->with('classes');

    it('should create a Model class with HasUuids trait', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        $class = ucfirst($class);

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

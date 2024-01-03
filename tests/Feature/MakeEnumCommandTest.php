<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:enum', function () {
    it('should create Enum class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.enum.path', 'Test/Enums');

        $class = ucfirst($class);

        artisan('make:enum', ['name' => $class]);
        $output = Artisan::output();

        $enumPath = app_path("Test/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            'namespace App\Test\Enums;',
            "enum $class",
        );
    })->with('classes');
});

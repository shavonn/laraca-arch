<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:view', function () {
    it('should create blade file at package configured path', function (string $class) {
        Config::set('laraca.struct.view.path', 'test/resources/views');

        artisan('make:view',
            ['name' => $class]);

        $filePath = assembleFullPath('view')."/{$class}.blade.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

    })->with('classes');

    it('should create blade file at Laravel configured path when view not set in laraca config', function () {
        Config::offsetUnset('view');

        $name = 'foo';

        artisan('make:view', ['name' => $name]);
        $viewPath = base_path("resources/views/{$name}.blade.php");

        expect($viewPath)->toBeFile("File not created at expected path:\n$viewPath");
    });
});

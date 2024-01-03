<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:view', function () {
    it('should create blade file at package configured path', function (string $class) {
        Config::set('laraca.struct.view.path', 'test/resources/views');

        artisan('make:view', ['name' => $class]);
        $output = Artisan::output();

        $viewPath = base_path("test/resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');
    })->with('classes');

    it('should create blade file at Laravel configured path when view not set in laraca config', function (string $class) {
        Config::offsetUnset('view');

        artisan('make:view', ['name' => $class]);
        $output = Artisan::output();

        $viewPath = base_path("resources/views/{$class}.blade.php");

        expect($viewPath)
            ->toBeFile("File not created at expected path:\n$viewPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($viewPath))->toContain('<div>');
    })->with('classes');
});

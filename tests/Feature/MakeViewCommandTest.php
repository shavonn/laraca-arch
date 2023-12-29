<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:view', function () {
    it('should create blade file at package configured path', function (string $class) {
        Config::set('laraca.structure.view.path', 'test/resources/views');
        $this->artisan('make:view',
            ['name' => $class]);

        $filePath = assembleFullPath('view')."/{$class}.blade.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

    })->with('classes');

    it('should create blade file at Laravel configured path when view not set in laraca config', function (string $class) {
        Config::offsetUnset('view');
        $this->artisan('make:view',
            ['name' => $class]);

        $output = Artisan::output();

        $filePath = base_path("resources/views/{$class}.blade.php");

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

    })->with('classes');
});

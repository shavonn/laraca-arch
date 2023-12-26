<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:view', function () {
    it('should create blade file at package configured path', function (string $class) {
        Config::set('laraca.view.path', 'test/resources/views');
        $this->artisan('make:view',
            ['name' => $class]);

        $filePath = assemblePath('view')."/{$class}.blade.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

    })->with('classes');

    it('should create blade file at Laravel configured path', function (string $class) {
        Config::offsetUnset('view');
        $this->artisan('make:view',
            ['name' => $class]);

        $filePath = base_path("resources/views/{$class}.blade.php");

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

    })->with('classes');
});

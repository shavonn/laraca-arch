<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:view', function () {
    it('should create View class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.view.path', 'test/resources/views');
        $this->artisan('make:view',
            ['name' => $class]);

        $filePath = assemblePath('view')."/{$class}.blade.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

    })->with('classes');
});

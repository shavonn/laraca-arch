<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:controller', function () {
    it('should create Controller class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.controller.path', 'Test/Http/Controllers');
        $this->artisan('make:controller',
            ['name' => $class]);

        $configPath = assemblePath('controller');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Controllers');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

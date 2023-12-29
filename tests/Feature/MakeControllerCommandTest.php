<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:controller', function () {
    it('should create Controller class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.controller.path', 'Test/Http/Controllers');
        $this->artisan('make:controller',
            ['name' => $class]);

        $configPath = assembleFullPath('controller');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Controllers');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

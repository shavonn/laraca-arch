<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:resource', function () {
    it('should create Resource class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.resource.path', 'Test/Http/Resources');
        $this->artisan('make:resource',
            ['name' => $class]);

        $configPath = assemblePath('resource');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Resources');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:middleware', function () {
    it('should create Middleware class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.middleware.path', 'Test/Http/Middleware');
        $this->artisan('make:middleware',
            ['name' => $class]);

        $configPath = assemblePath('middleware');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Middleware');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

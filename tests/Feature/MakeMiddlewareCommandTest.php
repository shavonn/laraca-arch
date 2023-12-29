<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:middleware', function () {
    it('should create Middleware class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.middleware.path', 'Test/Http/Middleware');
        $this->artisan('make:middleware',
            ['name' => $class]);

        $configPath = assembleFullPath('middleware');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Middleware');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

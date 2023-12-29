<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:request', function () {
    it('should create Request class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.request.path', 'Test/Http/Requests');
        $this->artisan('make:request',
            ['name' => $class]);

        $configPath = assembleFullPath('request');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Requests');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

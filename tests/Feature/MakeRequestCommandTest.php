<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:request', function () {
    it('should create Request class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.request.path', 'Test/Http/Requests');
        $this->artisan('make:request',
            ['name' => $class]);

        $configPath = assemblePath('request');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Requests');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

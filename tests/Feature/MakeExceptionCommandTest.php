<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:exception', function () {
    it('should create Exception class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.exception.namespace', 'Test\Exceptions');
        $this->artisan('make:exception',
            ['name' => $class]);

        $configPath = assemblePath('exception');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('exception'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

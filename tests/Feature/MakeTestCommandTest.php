<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:test', function () {
    it('should create Test class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.test.path', 'test/tests');
        $this->artisan('make:test',
            ['name' => $class]);

        $configPath = assemblePath('test');
        $filePath = "$configPath/Feature/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('Tests\Feature');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');

    it('should create Test class with namespace at path created from configured namespace with unit option', function (string $class) {
        $this->artisan('make:test',
            ['name' => $class,
                '--unit' => true],
        );

        $configPath = assemblePath('test');
        $filePath = "$configPath/Unit/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('Tests\Unit');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

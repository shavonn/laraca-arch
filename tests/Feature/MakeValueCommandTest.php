<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('make:value', function () {
    it('should create Value class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.value.namespace', 'Test\Data\Values');
        $this->artisan('make:value',
            ['name' => $class]);

        $configPath = assemblePath('value');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('value'));

        expect(File::get($filePath))
            ->toContain($configNamespace, Str::camel($class));

    })->with('classes');
});

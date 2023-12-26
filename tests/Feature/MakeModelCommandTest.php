<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:model', function () {
    it('should create Model class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.model.namespace', 'Test\Data\Models');
        $this->artisan('make:model',
            ['name' => $class]);

        $configPath = assemblePath('model');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('model'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');

    it('should create a Model class with HasUuids trait', function (string $class) {
        Config::set('laraca.model.namespace', 'Test\Data\Models');
        $this->artisan('make:model',
            ['name' => $class, '--uuid' => true]);

        $configPath = assemblePath('model');

        expect(File::get("$configPath/$class.php"))
            ->toContain('HasUuids');

    })->with('classes');
});

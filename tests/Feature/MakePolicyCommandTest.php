<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:policy', function () {
    it('should create Policy class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.policy.namespace', 'Test\Policies');
        $this->artisan('make:policy',
            ['name' => $class]);

        $configPath = assemblePath('policy');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('policy'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

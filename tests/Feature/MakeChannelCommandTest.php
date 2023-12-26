<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:channel', function () {
    it('should create Channel class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.channel.namespace', 'Test\Broadcasting');
        $this->artisan('make:channel',
            ['name' => $class]);

        $configPath = assemblePath('channel');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('channel'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

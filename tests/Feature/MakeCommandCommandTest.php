<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:command', function () {
    it('should create Command class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.command.namespace', 'Test\Console\Commands');
        $this->artisan('make:command',
            ['name' => $class]);

        $configPath = assemblePath('command');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('command'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

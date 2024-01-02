<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:channel', function () {
    it('should create Channel class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.channel.path', 'Test/Broadcasting');
        $this->artisan('make:channel',
            ['name' => $class]);

        $configPath = assembleFullPath('channel');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Broadcasting');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

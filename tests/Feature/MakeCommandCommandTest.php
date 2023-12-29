<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:command', function () {
    it('should create Command class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.command.path', 'Test/Console/Commands');
        $this->artisan('make:command',
            ['name' => $class]);

        $configPath = assembleFullPath('command');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Console\Commands');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

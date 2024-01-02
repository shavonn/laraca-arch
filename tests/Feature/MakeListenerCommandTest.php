<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:listener', function () {
    it('should create Listener class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.listener.path', 'Test/Listeners');
        $this->artisan('make:listener',
            ['name' => $class]);

        $configPath = assembleFullPath('listener');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Listeners');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

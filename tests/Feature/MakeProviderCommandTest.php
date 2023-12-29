<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:provider', function () {
    it('should create Provider class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.provider.path', 'Test/Providers');
        $this->artisan('make:provider',
            ['name' => $class]);

        $configPath = assembleFullPath('provider');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Providers');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

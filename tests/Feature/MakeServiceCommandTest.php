<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:service', function () {
    it('should create Service class and interface with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.service.path', 'Test/Services');
        $this->artisan('make:service',
            ['name' => $class]);

        $class = ucfirst($class);
        $configPath = assembleFullPath('service');
        $filePath = "$configPath/".$class.'Service.php';
        $interfaceFilePath = "$configPath/".$class.'ServiceInterface.php';

        $configNamespace = fullNamespaceStr('App\Test\Services');

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        expect(File::get($filePath))
            ->toContain($configNamespace);

        expect(File::exists($interfaceFilePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        expect(File::get($interfaceFilePath))
            ->toContain($configNamespace);

    })->with('classes');
});

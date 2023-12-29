<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:factory', function () {
    it('should create Factory class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.database.path', 'test/database');
        $this->artisan('make:factory',
            ['name' => $class]);

        $configPath = assembleFullPath('factory');
        $filePath = "$configPath/{$class}Factory.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('Test\Database\Factories');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

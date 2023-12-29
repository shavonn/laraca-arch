<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:seeder', function () {
    it('should create Seeder class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.database.path', 'test/database');
        $this->artisan('make:seeder',
            ['name' => $class]);

        $configPath = assembleFullPath('seeder');
        $filePath = "$configPath/{$class}.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('Test\Database\Seeders');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

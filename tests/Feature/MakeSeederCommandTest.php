<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:seeder', function () {
    it('should create Seeder class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.database.path', 'test/database');
        $this->artisan('make:seeder',
            ['name' => $class]);

        $configPath = assemblePath('seeder');
        $filePath = "$configPath/{$class}.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('Test\Database\Seeders');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

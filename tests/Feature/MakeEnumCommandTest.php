<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:enum', function () {
    it('should create Enum class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.enum.path', 'Test/Enums');
        $this->artisan('make:enum',
            ['name' => $class]);

        $configPath = assemblePath('enum');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Enums');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

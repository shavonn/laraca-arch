<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:enum', function () {
    it('should create Enum class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.enum.path', 'Test/Enums');
        $this->artisan('make:enum',
            ['name' => $class]);

        $configPath = assembleFullPath('enum');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Enums');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

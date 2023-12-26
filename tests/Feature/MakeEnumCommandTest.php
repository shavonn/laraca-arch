<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeEnumCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:enum', function () {
    it('should create Enum class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeEnumCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('enum');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('enum'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

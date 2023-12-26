<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeFactoryCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:factory', function () {
    it('should create Factory class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeFactoryCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('factory');
        $filePath = "$configPath/{$class}Factory.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('factory', false));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

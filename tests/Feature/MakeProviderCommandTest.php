<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeProviderCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:provider', function () {
    it('should create Provider class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeProviderCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('provider');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('provider'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

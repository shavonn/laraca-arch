<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeScopeCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:scope', function () {
    it('should create Scope class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeScopeCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('scope');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('scope'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

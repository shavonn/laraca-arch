<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeControllerCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:controller', function () {
    it('should create Controller class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeControllerCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('controller');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('controller'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

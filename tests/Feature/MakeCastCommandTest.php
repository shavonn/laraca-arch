<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:cast', function () {
    it('should create Cast class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan('make:cast',
            ['name' => $class]);

        $configPath = assemblePath('cast');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('cast'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

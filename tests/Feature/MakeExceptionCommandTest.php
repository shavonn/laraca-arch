<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:exception', function () {
    it('should create Exception class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.exception.path', 'Test/Exceptions');
        $this->artisan('make:exception',
            ['name' => $class]);

        $configPath = assembleFullPath('exception');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Exceptions');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

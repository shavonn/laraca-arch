<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:observer', function () {
    it('should create Observer class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.observer.path', 'Test/Data/Observers');
        $this->artisan('make:observer',
            ['name' => $class]);

        $configPath = assemblePath('observer');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Data\Observers');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

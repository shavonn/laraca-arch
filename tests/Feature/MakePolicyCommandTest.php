<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:policy', function () {
    it('should create Policy class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.policy.path', 'Test/Policies');
        $this->artisan('make:policy',
            ['name' => $class]);

        $configPath = assembleFullPath('policy');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Policies');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

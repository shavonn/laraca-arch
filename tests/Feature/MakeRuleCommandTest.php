<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:rule', function () {
    it('should create Rule class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.rule.path', 'Test/Rules');
        $this->artisan('make:rule',
            ['name' => $class]);

        $configPath = assembleFullPath('rule');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Rules');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

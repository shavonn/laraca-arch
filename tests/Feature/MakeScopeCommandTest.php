<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:scope', function () {
    it('should create Scope class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.model.path', 'Test/Data/Models');
        $this->artisan('make:scope',
            ['name' => $class]);

        $configPath = assembleFullPath('scope');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Data\Models\Scopes');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

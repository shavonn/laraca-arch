<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:cast', function () {
    it('should create Cast class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.cast.path', 'Test/Data/Casts');
        $this->artisan('make:cast',
            ['name' => $class]);

        $configPath = assembleFullPath('cast');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Data\Casts');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

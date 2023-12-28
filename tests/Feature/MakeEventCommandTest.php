<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:event', function () {
    it('should create Event class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.event.path', 'Test/Events');
        $this->artisan('make:event',
            ['name' => $class]);

        $configPath = assembleFullPath('event');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Events');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

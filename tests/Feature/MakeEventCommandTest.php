<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:event', function () {
    it('should create Event class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.event.path', 'Test/Events');
        $this->artisan('make:event',
            ['name' => $class]);

        $configPath = assemblePath('event');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Events');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

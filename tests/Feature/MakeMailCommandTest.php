<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:mail', function () {
    it('should create Mail class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.mail.path', 'Test/Mail');
        $this->artisan('make:mail',
            ['name' => $class]);

        $configPath = assemblePath('mail');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Mail');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

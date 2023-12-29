<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:mail', function () {
    it('should create Mail class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.mail.path', 'Test/Mail');
        $this->artisan('make:mail',
            ['name' => $class]);

        $configPath = assembleFullPath('mail');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Mail');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

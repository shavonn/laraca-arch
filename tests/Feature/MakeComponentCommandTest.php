<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeComponentCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('make:component', function () {
    it('should create Component class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeComponentCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('component');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $snake_class = Str::snake($class, '-');

        expect(File::exists(assemblePath('view')."/components/{$snake_class}.blade.php"))
            ->toBe(true, "File not created at expected path:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('component'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

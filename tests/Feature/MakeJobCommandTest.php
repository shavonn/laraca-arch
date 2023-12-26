<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeJobCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:job', function () {
    it('should create Job class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeJobCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('job');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('job'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeEventCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:event', function () {
    it('should create Event class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeEventCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('event');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('event'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

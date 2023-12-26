<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeTestCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:test', function () {
    it('should create Test class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeTestCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('test');
        $filePath = "$configPath/Feature/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = assembleNamespace('test', false);

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');

    it('should create Test class with namespace at path created from configured namespace with unit option', function (string $class) {
        $this->artisan(MakeTestCommand::class,
            ['name' => $class,
                '--unit' => true],
        );

        $configPath = assemblePath('test');
        $filePath = "$configPath/Unit/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

    })->with('classes');
});

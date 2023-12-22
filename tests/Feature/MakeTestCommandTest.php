<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeTestCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:test', function () {
    it('should create Test class at path from namespace', function (string $class) {
        $this->artisan(
            MakeTestCommand::class,
            ['name' => $class],
        );

        $configPath = config('laraca.test.path');
        $filePath = base_path("$configPath/Feature/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create Test class at path from namespace with unit option', function (string $class) {
        $this->artisan(
            MakeTestCommand::class,
            ['name' => $class,
                '--unit' => true],
        );

        $configPath = config('laraca.test.path');
        $filePath = base_path("$configPath/Unit/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Test class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeTestCommand::class,
            ['name' => $class],
        );

        $configPath = config('laraca.test.path');
        $configNamespace = pathToNamespace($configPath);

        expect(File::get(
            path: base_path("$configPath/Feature/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

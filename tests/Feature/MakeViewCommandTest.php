<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeViewCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:view', function () {
    it('should create View class at path from namespace', function (string $class) {
        $this->artisan(
            MakeViewCommand::class,
            ['name' => $class],
        );

        $filePath = base_path(config('laraca.view.path')."/{$class}.blade.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('arti:migration', function () {
    it('should create the Migration class when used', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');
        $this->artisan('arti:migration',
            ['name' => $class]);

        $now = now();
        $datetimeSubSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $datetimeNow = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);
        $configPath = assembleFullPath('migration');

        // accounts for second change variation that may occur in file name
        $filePathSubSecond = "$configPath/{$datetimeSubSecond}_{$snake_class}.php";
        $filePathNow = "$configPath/{$datetimeNow}_{$snake_class}.php";

        $output = Artisan::output();

        expect(File::exists($filePathNow) || File::exists($filePathSubSecond))
            ->toBe(true, "File not created at expected path:\n".$filePathNow."\n".$filePathSubSecond."\n".$output."\n\n");

    })->with('classes');

    it('should create the Migration class using path option', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');
        $this->artisan('arti:migration',
            ['name' => $class, '--path' => 'test/db/migrations']);

        $now = now()->format('Y_m_d_His');
        $snake_class = Str::snake($class);

        $filePath = base_path("test/db/migrations/{$now}_{$snake_class}.php");

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

    })->with('classes');
});

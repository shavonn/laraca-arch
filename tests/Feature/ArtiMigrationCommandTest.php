<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Pest\Laravel\artisan;

describe('arti:migration', function () {
    it('should create the Migration class when used', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('arti:migration', ['name' => $class]);

        $output = Artisan::output();

        $now = now();
        $subSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $now = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);

        $migrationsPath = base_path('test/database/migrations');

        // account for second change variation that may occur in file name
        $migrationPath1 = "$migrationsPath/{$subSecond}_{$snake_class}.php";
        $migrationPath2 = "$migrationsPath/{$now}_{$snake_class}.php";

        expect(File::exists($migrationPath1) || File::exists($migrationPath2))
            ->toBe(true, "File not created at expected path:\n$migrationPath1\n$migrationPath2\n$output\n\n");
    })->with('classes');

    it('should create the Migration class using path option', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('arti:migration', ['name' => $class, '--path' => 'test/db/migrations']);
        $output = Artisan::output();

        $now = now();
        $subSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $now = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);

        $migrationsPath = base_path('test/db/migrations');

        // account for second change variation that may occur in file name
        $migrationPath1 = "$migrationsPath/{$subSecond}_{$snake_class}.php";
        $migrationPath2 = "$migrationsPath/{$now}_{$snake_class}.php";

        expect(File::exists($migrationPath1) || File::exists($migrationPath2))
            ->toBe(true, "File not created at expected path:\n$migrationPath1\n$migrationPath2\n$output\n\n");

    })->with('classes');
});

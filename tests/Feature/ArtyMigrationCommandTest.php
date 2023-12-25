<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyMigrationCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('should create the Migration class when used', function (string $class) {
    $this->artisan(
        ArtyMigrationCommand::class,
        ['name' => $class],
    );

    $now = now();
    $datetimeSubSecond = $now->copy()->subSecond()->format('Y_m_d_His');
    $datetimeNow = $now->format('Y_m_d_His');

    $snake_class = Str::snake($class);
    $configPath = getDatabasePath('laraca.migration.path');

    // accounts for second change variation that may occur in file name
    $filePathSubSecond = base_path("$configPath/{$datetimeSubSecond}_{$snake_class}.php");
    $filePathNow = base_path("$configPath/{$datetimeNow}_{$snake_class}.php");

    $result = Artisan::output();

    expect(File::exists(
        path: $filePathNow,
    ) || File::exists(
        path: $filePathSubSecond,
    ))->toBe(true, "File not created at expected path:\n".$filePathNow."\n".$filePathSubSecond."\n".$result."\n\n");

})->with('classes');

it('should create the Migration class with path option', function (string $class) {
    $this->artisan(
        ArtyMigrationCommand::class,
        ['name' => $class,
            '--path' => 'test/db/migrations'],
    );

    $now = now()->format('Y_m_d_His');
    $snake_class = Str::snake($class);

    $filePath = base_path("test/db/migrations/{$now}_{$snake_class}.php");

    $result = Artisan::output();

    expect(File::exists(
        path: $filePath,
    ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");
})->with('classes');

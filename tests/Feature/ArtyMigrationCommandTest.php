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

    $now = now()->format('Y_m_d_Gis');
    $snake_class = Str::snake($class);

    $configPath = getDatabasePath('laraca.migration.path');
    $filePath = base_path("$configPath/{$now}_{$snake_class}.php");

    $result = Artisan::output();

    expect(File::exists(
        path: $filePath,
    ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

})->with('classes');

it('should create the Migration class with path option', function (string $class) {
    $this->artisan(
        ArtyMigrationCommand::class,
        ['name' => $class,
            '--path' => 'test/db/migrations'],
    );

    $now = now()->format('Y_m_d_Gis');
    $snake_class = Str::snake($class);

    $this->assertTrue(File::exists(
        path: base_path("test/db/migrations/{$now}_{$snake_class}.php"),
    ));
})->with('classes');

ll<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyMigrationCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('create the Migration class when used', function (string $class) {
    $this->artisan(
        ArtyMigrationCommand::class,
        ['name' => $class],
    );

    $now = now()->format('Y_m_d_Gis');
    $snake_class = Str::snake($class);

    $result = Artisan::output();
    $this->assertTrue(File::exists(
        path: base_path("test/database/migrations/{$now}_{$snake_class}.php"),
    ), 'File missing: '.$result);

})->with('classes');

it('create the Migration class when used in supplied path', function (string $class) {
    $this->artisan(
        ArtyMigrationCommand::class,
        ['name' => $class,
            '--path' => 'db/migrations'],
    );

    $now = now()->format('Y_m_d_Gis');
    $snake_class = Str::snake($class);

    $this->assertTrue(File::exists(
        path: base_path("db/migrations/{$now}_{$snake_class}.php"),
    ));
})->with('classes');

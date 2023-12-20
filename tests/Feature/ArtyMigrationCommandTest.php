ll<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyMigrationCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('create the Migration class when used', function (string $class) {
    $this->artisan(
        ArtyMigrationCommand::class,
        ['name' => $class],
    );

    $now = now()->format('Y_m_d_Gis');
    $snake_class = Str::snake($class);

    $this->assertTrue(File::exists(
        path: base_path("database/migrations/{$now}_{$snake_class}.php"),
    ));
})->with('classes');

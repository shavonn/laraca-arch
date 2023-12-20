<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtySeederCommand;
use Illuminate\Support\Facades\File;

it('create the Seeder class when used', function (string $class) {
    $this->artisan(
        ArtySeederCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: base_path("database/seeders/$class.php"),
    ));
})->with('classes');

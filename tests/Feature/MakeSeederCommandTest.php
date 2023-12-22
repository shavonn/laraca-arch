<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeSeederCommand;
use Illuminate\Support\Facades\File;

it('create the Seeder class when used', function (string $class) {
    $this->artisan(
        MakeSeederCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: base_path("test/database/seeders/$class.php"),
    ));
})->with('classes');

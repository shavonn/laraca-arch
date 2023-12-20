<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyFactoryCommand;
use Illuminate\Support\Facades\File;

it('create the Factory class when used', function (string $class) {
    $this->artisan(
        ArtyFactoryCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: base_path("database/factories/{$class}Factory.php"),
    ));
})->with('classes');

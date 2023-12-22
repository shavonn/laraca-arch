<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeFactoryCommand;
use Illuminate\Support\Facades\File;

it('create the Factory class when used', function (string $class) {
    $this->artisan(
        MakeFactoryCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: base_path("test/database/factories/{$class}Factory.php"),
    ));
})->with('classes');

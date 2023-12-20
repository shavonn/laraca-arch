<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyCastCommand;
use Illuminate\Support\Facades\File;

it('create the Cast class when used', function (string $class) {
    $this->artisan(
        ArtyCastCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Data/Casts/$class.php"),
    ));
})->with('classes');

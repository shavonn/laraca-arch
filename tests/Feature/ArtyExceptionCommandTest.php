<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyExceptionCommand;
use Illuminate\Support\Facades\File;

it('create the Exception class when used', function (string $class) {
    $this->artisan(
        ArtyExceptionCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Exceptions/$class.php"),
    ));
})->with('classes');

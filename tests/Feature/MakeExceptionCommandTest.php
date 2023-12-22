<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeExceptionCommand;
use Illuminate\Support\Facades\File;

it('create the Exception class when used', function (string $class) {
    $this->artisan(
        MakeExceptionCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Exceptions/$class.php"),
    ), 'File does not exist.');
})->with('classes');

<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeMailCommand;
use Illuminate\Support\Facades\File;

it('create the Mail class when used', function (string $class) {
    $this->artisan(
        MakeMailCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Mail/$class.php"),
    ));
})->with('classes');

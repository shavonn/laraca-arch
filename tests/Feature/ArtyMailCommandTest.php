<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyMailCommand;
use Illuminate\Support\Facades\File;

it('create the Mail class when used', function (string $class) {
    $this->artisan(
        ArtyMailCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Mail/$class.php"),
    ));
})->with('classes');

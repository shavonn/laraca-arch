<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyJobCommand;
use Illuminate\Support\Facades\File;

it('create the Job class when used', function (string $class) {
    $this->artisan(
        ArtyJobCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Jobs/$class.php"),
    ));
})->with('classes');

<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyChannelCommand;
use Illuminate\Support\Facades\File;

it('create the Channel class when used', function (string $class) {
    $this->artisan(
        ArtyChannelCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Broadcasting/$class.php"),
    ));
})->with('classes');

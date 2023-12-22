<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeChannelCommand;
use Illuminate\Support\Facades\File;

it('create the Channel class when used', function (string $class) {
    $this->artisan(
        MakeChannelCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Broadcasting/$class.php"),
    ), 'File does not exist.');
})->with('classes');

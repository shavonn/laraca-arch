<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyListenerCommand;
use Illuminate\Support\Facades\File;

it('create the Listener class when used', function (string $class) {
    $this->artisan(
        ArtyListenerCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Listeners/$class.php"),
    ));
})->with('classes');

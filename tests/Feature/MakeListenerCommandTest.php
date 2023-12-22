<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeListenerCommand;
use Illuminate\Support\Facades\File;

it('create the Listener class when used', function (string $class) {
    $this->artisan(
        MakeListenerCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Listeners/$class.php"),
    ));
})->with('classes');

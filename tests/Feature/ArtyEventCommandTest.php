<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyEventCommand;
use Illuminate\Support\Facades\File;

it('create the Event class when used', function (string $class) {
    $this->artisan(
        ArtyEventCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Events/$class.php"),
    ));
})->with('classes');

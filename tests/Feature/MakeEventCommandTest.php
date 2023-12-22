<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeEventCommand;
use Illuminate\Support\Facades\File;

it('create the Event class when used', function (string $class) {
    $this->artisan(
        MakeEventCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Events/$class.php"),
    ), 'File does not exist.');
})->with('classes');

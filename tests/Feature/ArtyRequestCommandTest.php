<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyRequestCommand;
use Illuminate\Support\Facades\File;

it('create the Request class when used', function (string $class) {
    $this->artisan(
        ArtyRequestCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Http/Requests/$class.php"),
    ));
})->with('classes');

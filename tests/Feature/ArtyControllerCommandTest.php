<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyControllerCommand;
use Illuminate\Support\Facades\File;

it('create the Controller class when used', function (string $class) {
    $this->artisan(
        ArtyControllerCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Http/Controllers/$class.php"),
    ));
})->with('classes');

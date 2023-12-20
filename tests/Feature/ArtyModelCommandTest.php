<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyModelCommand;
use Illuminate\Support\Facades\File;

it('create the Model class when used', function (string $class) {
    $this->artisan(
        ArtyModelCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Data/Models/$class.php"),
    ));
})->with('classes');

<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeModelCommand;
use Illuminate\Support\Facades\File;

it('create the Model class when used', function (string $class) {
    $this->artisan(
        MakeModelCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Data/Models/$class.php"),
    ));
})->with('classes');

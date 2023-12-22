<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeControllerCommand;
use Illuminate\Support\Facades\File;

it('create the Controller class when used', function (string $class) {
    $this->artisan(
        MakeControllerCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Http/Controllers/$class.php"),
    ), 'File does not exist.');
})->with('classes');

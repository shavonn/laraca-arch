<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyResourceCommand;
use Illuminate\Support\Facades\File;

it('create the Resource class when used', function (string $class) {
    $this->artisan(
        ArtyResourceCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Http/Resources/$class.php"),
    ));
})->with('classes');

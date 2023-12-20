<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyCommandCommand;
use Illuminate\Support\Facades\File;

it('create the Command class when used', function (string $class) {
    $this->artisan(
        ArtyCommandCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Console/Commands/$class.php"),
    ));
})->with('classes');

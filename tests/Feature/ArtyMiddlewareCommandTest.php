<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyMiddlewareCommand;
use Illuminate\Support\Facades\File;

it('create the Middleware class when used', function (string $class) {
    $this->artisan(
        ArtyMiddlewareCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Http/Middleware/$class.php"),
    ));
})->with('classes');

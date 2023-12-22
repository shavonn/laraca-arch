<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeMiddlewareCommand;
use Illuminate\Support\Facades\File;

it('create the Middleware class when used', function (string $class) {
    $this->artisan(
        MakeMiddlewareCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Http/Middleware/$class.php"),
    ));
})->with('classes');

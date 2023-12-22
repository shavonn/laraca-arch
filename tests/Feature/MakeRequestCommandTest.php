<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeRequestCommand;
use Illuminate\Support\Facades\File;

it('create the Request class when used', function (string $class) {
    $this->artisan(
        MakeRequestCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Http/Requests/$class.php"),
    ));
})->with('classes');

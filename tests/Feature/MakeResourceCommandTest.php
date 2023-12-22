<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeResourceCommand;
use Illuminate\Support\Facades\File;

it('create the Resource class when used', function (string $class) {
    $this->artisan(
        MakeResourceCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Http/Resources/$class.php"),
    ));
})->with('classes');

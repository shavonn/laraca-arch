<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeJobCommand;
use Illuminate\Support\Facades\File;

it('create the Job class when used', function (string $class) {
    $this->artisan(
        MakeJobCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Jobs/$class.php"),
    ));
})->with('classes');

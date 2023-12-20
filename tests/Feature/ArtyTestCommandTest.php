<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyTestCommand;
use Illuminate\Support\Facades\File;

it('create the Test class when used', function (string $class) {
    $this->artisan(
        ArtyTestCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: base_path("tests/Feature/{$class}.php"),
    ));
})->with('classes');

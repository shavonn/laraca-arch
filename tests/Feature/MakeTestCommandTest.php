<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeTestCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

it('create the Test class when used', function (string $class) {
    $this->artisan(
        MakeTestCommand::class,
        ['name' => $class],
    );

    $result = Artisan::output();

    $this->assertTrue(File::exists(
        path: base_path("test/tests/Feature/{$class}.php"),
    ), $result);
})->with('classes');

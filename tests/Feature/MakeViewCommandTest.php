lealea<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeViewCommand;
use Illuminate\Support\Facades\File;

it('create the View class and blade file when used', function (string $class) {
    $this->artisan(
        MakeViewCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: base_path("test/resources/views/{$class}.blade.php"),
    ));
})->with('classes');

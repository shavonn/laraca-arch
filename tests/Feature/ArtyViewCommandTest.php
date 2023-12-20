lealea<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyViewCommand;
use Illuminate\Support\Facades\File;

it('create the View class and blade file when used', function (string $class) {
    $this->artisan(
        ArtyViewCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: base_path("resources/views/{$class}.blade.php"),
    ));
})->with('classes');

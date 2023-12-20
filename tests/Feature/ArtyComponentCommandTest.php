lealea<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyComponentCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('create the Component class and blade file when used', function (string $class) {
    $this->artisan(
        ArtyComponentCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("View/Components/$class.php"),
    ));

    $snake_class = Str::snake($class, '-');
    $this->assertTrue(File::exists(
        path: base_path("resources/views/components/{$snake_class}.blade.php"),
    ));
})->with('classes');

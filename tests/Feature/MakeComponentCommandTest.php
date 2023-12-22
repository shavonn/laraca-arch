lealea<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeComponentCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('create the Component class and blade file when used', function (string $class) {
    $this->artisan(
        MakeComponentCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/View/Components/$class.php"),
    ), 'File does not exist.');

    $result = Artisan::output();
    $snake_class = Str::snake($class, '-');
    $this->assertTrue(File::exists(
        path: base_path("test/resources/views/components/{$snake_class}.blade.php"),
    ), 'File does not exist. '.$result);
})->with('classes');

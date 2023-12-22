<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeCommandCommand;
use Illuminate\Support\Facades\File;

it('create the Command class when used', function (string $class) {
    $this->artisan(
        MakeCommandCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Console/Commands/$class.php"),
    ), 'File does not exist.');
})->with('classes');

<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyObserverCommand;
use Illuminate\Support\Facades\File;

it('create the Observer class when used', function (string $class) {
    $this->artisan(
        ArtyObserverCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Data/Observers/$class.php"),
    ));
})->with('classes');

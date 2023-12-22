<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeObserverCommand;
use Illuminate\Support\Facades\File;

it('create the Observer class when used', function (string $class) {
    $this->artisan(
        MakeObserverCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Data/Observers/$class.php"),
    ));
})->with('classes');

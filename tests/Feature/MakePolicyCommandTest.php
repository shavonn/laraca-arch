<?php

use HandsomeBrown\Laraca\Foundation\Console\MakePolicyCommand;
use Illuminate\Support\Facades\File;

it('create the Policy class when used', function (string $class) {
    $this->artisan(
        MakePolicyCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Policies/$class.php"),
    ));
})->with('classes');

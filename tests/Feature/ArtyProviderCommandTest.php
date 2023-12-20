<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyProviderCommand;
use Illuminate\Support\Facades\File;

it('create the Provider class when used', function (string $class) {
    $this->artisan(
        ArtyProviderCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Providers/$class.php"),
    ));
})->with('classes');

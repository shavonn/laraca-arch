<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeProviderCommand;
use Illuminate\Support\Facades\File;

it('create the Provider class when used', function (string $class) {
    $this->artisan(
        MakeProviderCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Providers/$class.php"),
    ));
})->with('classes');

<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyScopeCommand;
use Illuminate\Support\Facades\File;

it('create the Scope class when used', function (string $class) {
    $this->artisan(
        ArtyScopeCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Data/Models/Scopes/$class.php"),
    ));
})->with('classes');

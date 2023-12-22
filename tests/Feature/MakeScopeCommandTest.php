<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeScopeCommand;
use Illuminate\Support\Facades\File;

it('create the Scope class when used', function (string $class) {
    $this->artisan(
        MakeScopeCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Data/Models/Scopes/$class.php"),
    ));
})->with('classes');

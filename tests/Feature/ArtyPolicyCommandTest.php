<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyPolicyCommand;
use Illuminate\Support\Facades\File;

it('create the Policy class when used', function (string $class) {
    $this->artisan(
        ArtyPolicyCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Policies/$class.php"),
    ));
})->with('classes');

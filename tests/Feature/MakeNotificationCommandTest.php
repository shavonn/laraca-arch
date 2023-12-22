<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeNotificationCommand;
use Illuminate\Support\Facades\File;

it('create the Notification class when used', function (string $class) {
    $this->artisan(
        MakeNotificationCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Notifications/$class.php"),
    ));
})->with('classes');

<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyNotificationCommand;
use Illuminate\Support\Facades\File;

it('create the Notification class when used', function (string $class) {
    $this->artisan(
        ArtyNotificationCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Notifications/$class.php"),
    ));
})->with('classes');

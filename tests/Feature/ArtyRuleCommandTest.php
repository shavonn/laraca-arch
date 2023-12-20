<?php

use HandsomeBrown\Laraca\Foundation\Console\ArtyRuleCommand;
use Illuminate\Support\Facades\File;

it('create the Rule class when used', function (string $class) {
    $this->artisan(
        ArtyRuleCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Rules/$class.php"),
    ));
})->with('classes');

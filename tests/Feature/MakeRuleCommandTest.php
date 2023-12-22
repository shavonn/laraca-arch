<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeRuleCommand;
use Illuminate\Support\Facades\File;

it('create the Rule class when used', function (string $class) {
    $this->artisan(
        MakeRuleCommand::class,
        ['name' => $class],
    );

    $this->assertTrue(File::exists(
        path: app_path("Test/Rules/$class.php"),
    ));
})->with('classes');

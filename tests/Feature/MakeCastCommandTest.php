<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeCastCommand;
use Illuminate\Support\Facades\File;

it('create the Cast class when used', function (string $class) {
    $this->artisan(
        MakeCastCommand::class,
        ['name' => $class],
    );

    $filePath = app_path("Test/Data/Casts/$class.php");
    $this->assertTrue(File::exists(
        path: $filePath,
    ), "File does not exist.\n$filePath\n\n");

    $this->assertStringContainsString('namespace App\Test\Data\Casts;', File::get(
        path: app_path("Test/Data/Casts/$class.php")), 'Namespace not found.');

})->with('classes');

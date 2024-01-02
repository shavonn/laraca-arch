<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:channel', function () {
    it('should create Channel class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.channel.path', 'Test/Broadcasting');

        artisan('make:channel', ['name' => $class]);

        $channelPath = app_path("Test/Broadcasting/$class.php");

        expect($channelPath)->toBeFile();

        expect(File::get($channelPath))->toContain(
            'namespace App\Test\Broadcasting;',
            "class $class",
        );
    })->with('classes');
});

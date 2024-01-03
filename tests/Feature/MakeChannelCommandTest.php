<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:channel', function () {
    it('should create Channel class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.channel.path', 'Test/Broadcasting');

        $class = ucfirst($class);

        artisan('make:channel', ['name' => $class]);
        $output = Artisan::output();

        $channelPath = app_path("Test/Broadcasting/$class.php");

        expect($channelPath)
            ->toBeFile("File not created at expected path:\n$channelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($channelPath))->toContain(
            'namespace App\Test\Broadcasting;',
            "class $class",
        );
    })->with('classes');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:listener', function () {
    it('should create Listener class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.listener.path', 'Test/Listeners');

        $class = ucfirst($class);

        artisan('make:listener', ['name' => $class]);
        $output = Artisan::output();

        $listenerPath = app_path("Test/Listeners/$class.php");

        expect($listenerPath)
            ->toBeFile("File not created at expected path:\n$listenerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($listenerPath))->toContain(
            'namespace App\Test\Listeners;',
            "class $class",
        );
    })->with('classes');
});

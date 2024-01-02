<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:event', function () {
    it('should create Event class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.event.path', 'Test/Events');

        artisan('make:event', ['name' => $class]);

        $eventPath = app_path("Test/Events/$class.php");

        expect($eventPath)->toBeFile();

        expect(File::get($eventPath))->toContain(
            'namespace App\Test\Events;',
            "class $class",
        );
    })->with('classes');
});

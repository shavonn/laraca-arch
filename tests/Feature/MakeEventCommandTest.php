<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:event', function () {
    it('should create Event class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.event.path', 'Test/Events');

        $class = getName($class);

        artisan('make:event', ['name' => $class]);
        $output = Artisan::output();

        $eventPath = app_path("Test/Events/$class.php");

        expect($eventPath)
            ->toBeFile("File not created at expected path:\n$eventPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($eventPath))->toContain(
            'namespace App\Test\Events;',
            "class $class",
        );
    })->with('classes');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:command', function () {
    it('should create Command class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.command.path', 'Test/Console/Commands');

        $class = ucfirst($class);

        artisan('make:command', ['name' => $class]);
        $output = Artisan::output();

        $commandPath = app_path("Test/Console/Commands/$class.php");

        expect($commandPath)
            ->toBeFile("File not created at expected path:\n$commandPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($commandPath))->toContain(
            'namespace App\Test\Console\Commands;',
            "class $class",
        );
    })->with('classes');
});

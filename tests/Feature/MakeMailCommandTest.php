<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:mail', function () {
    it('should create Mail class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.mail.path', 'Test/Mail');

        artisan('make:mail', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $mailPath = app_path("Test/Mail/$class.php");

        expect($mailPath)
            ->toBeFile("File not created at expected path:\n$mailPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailPath))->toContain(
            'namespace App\Test\Mail;',
            "class $class",
        );
    })->with('classes');
});

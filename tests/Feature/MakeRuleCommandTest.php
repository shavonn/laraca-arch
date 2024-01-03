<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:rule', function () {
    it('should create Rule class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.rule.path', 'Test/Rules');

        artisan('make:rule', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $rulePath = app_path("Test/Rules/$class.php");

        expect($rulePath)
            ->toBeFile("File not created at expected path:\n$rulePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($rulePath))->toContain(
            'namespace App\Test\Rules;',
            "class $class",
        );
    })->with('classes');
});

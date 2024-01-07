<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:observer', function () {
    it('should create Observer class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.observer.path', 'Test/Data/Observers');

        artisan('make:observer', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);

        $observerPath = app_path("Test/Data/Observers/$class.php");

        expect($observerPath)
            ->toBeFile("File not created at expected path:\n$observerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($observerPath))->toContain(
            'namespace App\Test\Data\Observers;',
            "class $class",
        );
    })->with('classes');
});

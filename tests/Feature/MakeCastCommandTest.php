<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:cast', function () {
    it('should create Cast class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.cast.path', 'Test/Data/Casts');

        artisan('make:cast', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $castPath = app_path("Test/Data/Casts/$class.php");

        expect($castPath)
            ->toBeFile("File not created at expected path:\n$castPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($castPath))->toContain(
            'namespace App\Test\Data\Casts;',
            "class $class",
        );
    })->with('classes');
});

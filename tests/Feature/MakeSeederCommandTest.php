<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:seeder', function () {
    it('should create Seeder class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('make:seeder', ['name' => $class]);
        $output = Artisan::output();

        $class = ucfirst($class);

        $seederPath = base_path("test/database/seeders/$class.php");

        expect($seederPath)
            ->toBeFile("File not created at expected path:\n$seederPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($seederPath))->toContain(
            'namespace Test\Database\Seeders;',
            "class $class",
        );
    })->with('classes');
});

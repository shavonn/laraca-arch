<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:job', function () {
    it('should create Job class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.job.path', 'Test/Jobs');

        artisan('make:job', ['name' => $class]);

        $jobPath = app_path("Test/Jobs/$class.php");

        expect($jobPath)->toBeFile();

        expect(File::get($jobPath))->toContain(
            'namespace App\Test\Jobs;',
            "class $class",
        );
    })->with('classes');
});

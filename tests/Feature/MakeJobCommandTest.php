<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:job', function () {
    it('should create Job class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.job.path', 'Test/Jobs');

        $class = ucfirst($class);

        artisan('make:job', ['name' => $class]);
        $output = Artisan::output();

        $jobPath = app_path("Test/Jobs/$class.php");

        expect($jobPath)
            ->toBeFile("File not created at expected path:\n$jobPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($jobPath))->toContain(
            'namespace App\Test\Jobs;',
            "class $class",
        );
    })->with('classes');
});

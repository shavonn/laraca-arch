<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('make:job', function () {
    it('should create Job class with namespace at path created from configured namespace', function (string $class) {
        Config::set('laraca.job.path', 'Test/Jobs');
        $this->artisan('make:job',
            ['name' => $class]);

        $configPath = assemblePath('job');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Jobs');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

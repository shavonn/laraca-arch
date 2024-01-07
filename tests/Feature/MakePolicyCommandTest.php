<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:policy', function () {
    it('should create Policy class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.policy.path', 'Test/Policies');

        artisan('make:policy', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);

        $policyPath = app_path("Test/Policies/$class.php");

        expect($policyPath)
            ->toBeFile("File not created at expected path:\n$policyPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($policyPath))->toContain(
            'namespace App\Test\Policies;',
            "class $class",
        );
    })->with('classes');
});

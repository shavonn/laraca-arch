<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:policy', function () {
    it('should create Policy class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.struct.policy.path', 'Test/Policies');

        artisan('make:policy', ['name' => $class]);

        $policyPath = app_path("Test/Policies/$class.php");

        expect($policyPath)->toBeFile();

        expect(File::get($policyPath))->toContain(
            'namespace App\Test\Policies;',
            "class $class",
        );
    })->with('classes');
});

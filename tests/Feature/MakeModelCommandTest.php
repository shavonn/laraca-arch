<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:model', function () {
    it('should create Model and test in config path', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        artisan('make:model', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $modelPath = app_path("Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            'namespace App\Test\Data\Models;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $modelTestPath = base_path("tests/Feature/$classTest.php");

        expect($modelTestPath)
            ->toBeFile("File not created at expected path:\n$modelTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelTestPath))->toContain(
            'namespace Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Model and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        artisan('make:model', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $modelPath = app_path("Domains/$domain/Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            "namespace App\Domains\\$domain\Test\Data\Models;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $modelTestPath = app_path("Domains/$domain/tests/Feature/$classTest.php");

        expect($modelTestPath)
            ->toBeFile("File not created at expected path:\n$modelTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Model and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        artisan('make:model', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $modelPath = app_path("Services/$service/Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            "namespace App\Services\\$service\Test\Data\Models;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $modelTestPath = app_path("Services/$service/tests/Feature/$classTest.php");

        expect($modelTestPath)
            ->toBeFile("File not created at expected path:\n$modelTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Model and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        artisan('make:model', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $modelPath = app_path("Domains/$domain/Services/$service/Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Data\Models;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $modelTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($modelTestPath)
            ->toBeFile("File not created at expected path:\n$modelTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');

    it('should create Model and test in config path with HasUuids trait', function (string $class) {
        Config::set('laraca.struct.model.path', 'Test/Data/Models');

        $class = getName($class);

        artisan('make:model', ['name' => $class, '--uuid' => true]);
        $output = Artisan::output();

        $modelPath = app_path("Test/Data/Models/$class.php");

        expect($modelPath)
            ->toBeFile("File not created at expected path:\n$modelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($modelPath))->toContain(
            'namespace App\Test\Data\Models;',
            "class $class",
            'HasUuids',
        );
    })->with('classes');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:cast', function () {
    it('should create Cast in config path', function (string $class) {
        Config::set('laraca.struct.cast.path', 'Test/Data/Casts');

        artisan('make:cast', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $castPath = app_path("Test/Data/Casts/$class.php");

        expect($castPath)
            ->toBeFile("File not created at expected path:\n$castPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($castPath))->toContain(
            'namespace App\Test\Data\Casts;',
            "class $class",
        );
    })->with('classes');

    it('should create Cast in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.cast.path', 'Test/Data/Casts');

        artisan('make:cast', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $castPath = app_path("Domains/$domain/Test/Data/Casts/$class.php");

        expect($castPath)
            ->toBeFile("File not created at expected path:\n$castPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($castPath))->toContain(
            "namespace App\Domains\\$domain\Test\Data\Casts;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Cast in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.cast.path', 'Test/Data/Casts');

        artisan('make:cast', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $castPath = app_path("Services/$service/Test/Data/Casts/$class.php");

        expect($castPath)
            ->toBeFile("File not created at expected path:\n$castPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($castPath))->toContain(
            "namespace App\Services\\$service\Test\Data\Casts;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Cast in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.cast.path', 'Test/Data/Casts');

        artisan('make:cast', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $castPath = app_path("Domains/$domain/Services/$service/Test/Data/Casts/$class.php");

        expect($castPath)
            ->toBeFile("File not created at expected path:\n$castPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($castPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Data\Casts;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

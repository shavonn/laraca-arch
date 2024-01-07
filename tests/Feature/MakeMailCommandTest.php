<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:mail', function () {
    it('should create Mail and test in config path', function (string $class) {
        Config::set('laraca.struct.mail.path', 'Test/Mail');

        artisan('make:mail', ['name' => $class, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $mailPath = app_path("Test/Mail/$class.php");

        expect($mailPath)
            ->toBeFile("File not created at expected path:\n$mailPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailPath))->toContain(
            'namespace App\Test\Mail;',
            "class $class",
        );

        $classTest = getName($class)->finish('Test');
        $mailTestPath = base_path("tests/Feature/$classTest.php");

        expect($mailTestPath)
            ->toBeFile("File not created at expected path:\n$mailTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailTestPath))->toContain(
            'namespace Tests\Feature;',
            "class $classTest",
        );
    })->with('classes');

    it('should create Mail and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.mail.path', 'Test/Mail');

        artisan('make:mail', ['name' => $class, '--domain' => $domain, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $mailPath = app_path("Domains/$domain/Test/Mail/$class.php");

        expect($mailPath)
            ->toBeFile("File not created at expected path:\n$mailPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailPath))->toContain(
            "namespace App\Domains\\$domain\Test\Mail;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $mailTestPath = app_path("Domains/$domain/tests/Feature/$classTest.php");

        expect($mailTestPath)
            ->toBeFile("File not created at expected path:\n$mailTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailTestPath))->toContain(
            "namespace App\Domains\\$domain\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Mail and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.mail.path', 'Test/Mail');

        artisan('make:mail', ['name' => $class, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $mailPath = app_path("Services/$service/Test/Mail/$class.php");

        expect($mailPath)
            ->toBeFile("File not created at expected path:\n$mailPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailPath))->toContain(
            "namespace App\Services\\$service\Test\Mail;",
            "class $class",
        );

        $classTest = getName($class)->finish('Test');

        $mailTestPath = app_path("Services/$service/tests/Feature/$classTest.php");

        expect($mailTestPath)
            ->toBeFile("File not created at expected path:\n$mailTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailTestPath))->toContain(
            "namespace App\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains');

    it('should create Mail and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.mail.path', 'Test/Mail');

        artisan('make:mail', ['name' => $class, '--domain' => $domain, '--service' => $service, '--test' => true]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $mailPath = app_path("Domains/$domain/Services/$service/Test/Mail/$class.php");

        expect($mailPath)
            ->toBeFile("File not created at expected path:\n$mailPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Mail;",
            "class $class",
        );
        $classTest = getName($class)->finish('Test');
        $mailTestPath = app_path("Domains/$domain/Services/$service/tests/Feature/$classTest.php");

        expect($mailTestPath)
            ->toBeFile("File not created at expected path:\n$mailTestPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($mailTestPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Tests\Feature;",
            "class $classTest",
        );
    })->with('classes', 'domains', 'domains');
});

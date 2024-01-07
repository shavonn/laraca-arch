<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:event', function () {
    it('should create Event in config path', function (string $class) {
        Config::set('laraca.struct.event.path', 'Test/Events');

        artisan('make:event', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $eventPath = app_path("Test/Events/$class.php");

        expect($eventPath)
            ->toBeFile("File not created at expected path:\n$eventPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($eventPath))->toContain(
            'namespace App\Test\Events;',
            "class $class",
        );
    })->with('classes');

    it('should create Event in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.event.path', 'Test/Events');

        artisan('make:event', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $eventPath = app_path("Domains/$domain/Test/Events/$class.php");

        expect($eventPath)
            ->toBeFile("File not created at expected path:\n$eventPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($eventPath))->toContain(
            "namespace App\Domains\\$domain\Test\Events;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Event in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.event.path', 'Test/Events');

        artisan('make:event', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $eventPath = app_path("Services/$service/Test/Events/$class.php");

        expect($eventPath)
            ->toBeFile("File not created at expected path:\n$eventPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($eventPath))->toContain(
            "namespace App\Services\\$service\Test\Events;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Event in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.event.path', 'Test/Events');

        artisan('make:event', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $eventPath = app_path("Domains/$domain/Services/$service/Test/Events/$class.php");

        expect($eventPath)
            ->toBeFile("File not created at expected path:\n$eventPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($eventPath))->toContain(
            "namespace App\Domains\\$domain\Services\\$service\Test\Events;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

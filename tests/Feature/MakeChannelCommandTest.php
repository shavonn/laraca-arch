<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('make:channel', function () {
    it('should create Channel in config path', function (string $class) {
        Config::set('laraca.struct.channel.path', 'Test/Broadcasting');

        artisan('make:channel', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $channelPath = app_path("Test/Broadcasting/$class.php");

        expect($channelPath)
            ->toBeFile("File not created at expected path:\n$channelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($channelPath))->toContain(
            'namespace App\Test\Broadcasting;',
            "class $class",
        );
    })->with('classes');

    it('should create Channel in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:channel', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);
        $channelPath = app_path("Test/Domains/$domain/Broadcasting/$class.php");

        expect($channelPath)
            ->toBeFile("File not created at expected path:\n$channelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($channelPath))->toContain(
            "namespace App\Test\Domains\\$domain\Broadcasting;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Channel in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('make:channel', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $channelPath = app_path("Test/Services/$service/Broadcasting/$class.php");

        expect($channelPath)
            ->toBeFile("File not created at expected path:\n$channelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($channelPath))->toContain(
            "namespace App\Test\Services\\$service\Broadcasting;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should create Channel in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:channel', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $class = getName($class);
        $service = getName($service);
        $domain = getName($domain);

        $channelPath = app_path("Test/Domains/$domain/Services/$service/Broadcasting/$class.php");

        expect($channelPath)
            ->toBeFile("File not created at expected path:\n$channelPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($channelPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$service\Broadcasting;",
            "class $class",
        );
    })->with('classes', 'domains', 'domains');
});

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\artisan;

describe('use domains', function () {
    it('should use domain settings in path/namespace when enabled and domain arg', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('make:controller', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);

        $contollerPath = app_path("Test/Domains/$domain/Http/Controllers/$class.php");

        expect($contollerPath)
            ->toBeFile("File not created at expected path:\n$contollerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($contollerPath))->toContain(
            "App\Test\Domains\\$domain\Http\Controllers",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should not use parent domain when path is null', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', null);

        artisan('make:enum', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);

        $enumPath = app_path("$domain/Enums/$class.php");

        expect($enumPath)
            ->toBeFile("File not created at expected path:\n$enumPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($enumPath))->toContain(
            "App\\$domain\Enums",
            "enum $class",
        );

    })->with('classes', 'domains');

    it('should not use domain settings in path/namespace when enabled and no domain arg', function (string $class) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'TestDomains');
        Config::set('laraca.struct.controller.path', 'Test/Http/Controllers');

        artisan('make:controller', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $contollerPath = app_path("Test/Http/Controllers/$class.php");

        expect($contollerPath)
            ->toBeFile("File not created at expected path:\n$contollerPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($contollerPath))->toContain(
            "App\Test\Http\Controllers",
            "class $class",
        );

    })->with('classes');
});

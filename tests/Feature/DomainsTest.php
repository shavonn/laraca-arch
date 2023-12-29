<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('use domains', function () {
    it('should use domain settings in path/namespace when enabled and domain arg', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'TestDomains');
        $this->artisan('make:controller',
            ['name' => $class,
                'domain' => $domain]);

        $output = Artisan::output();

        $configPath = assembleFullPath('controller', $domain);
        $filePath = "$configPath/$class.php";

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr("App\TestDomains\\".ucfirst($domain)."\Http\Controllers");

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes', 'domains');

    it('should not use domain settings in path/namespace when enabled and no domain arg', function (string $class) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'TestDomains');
        Config::set('laraca.struct.controller.path', 'Test/Http/Controllers');
        $this->artisan('make:controller',
            ['name' => $class]);

        $configPath = assembleFullPath('controller');
        $filePath = "$configPath/$class.php";

        $output = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$output."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Http\Controllers');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

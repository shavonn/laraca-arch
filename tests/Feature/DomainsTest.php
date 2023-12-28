<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

describe('use domains', function () {
    it('should use domain settings in path/namespace when enabled and domain arg', function (string $class, string $domain) {
        Config::set('laraca.domains.enabled', true);
        Config::set('laraca.domains.parent_dir', 'TestDomain');
        $this->artisan('make:cast',
            ['name' => $class,
                'domain' => $domain]);

        $result = Artisan::output();

        $configPath = assembleFullPath('cast', $domain);
        $filePath = "$configPath/$class.php";

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr("App\TestDomain\\".ucfirst($domain)."\Data\Casts");

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes', 'domains');

    it('should not use domain settings in path/namespace when enabled and no domain arg', function (string $class) {
        Config::set('laraca.domains.enabled', true);
        Config::set('laraca.domains.parent_dir', 'TestDomain');
        Config::set('laraca.structure.cast.path', 'Test/Data/Casts');
        $this->artisan('make:cast',
            ['name' => $class]);

        $configPath = assembleFullPath('cast');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\Data\Casts');

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

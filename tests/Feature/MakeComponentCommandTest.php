<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('make:component', function () {
    it('should create Component class with namespace and path created from configured vals', function (string $class) {
        Config::set('laraca.structure.component.path', 'Test/View/Components');
        Config::set('laraca.structure.view.path', 'test/resources/views');
        $this->artisan('make:component',
            ['name' => $class]);

        $configPath = assembleFullPath('component');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr('App\Test\View\Components');

        expect(File::get($filePath))
            ->toContain($configNamespace);

        $snake_class = Str::snake($class, '-');
        $viewPath = assembleFullPath('view')."/components/{$snake_class}.blade.php";

        expect(File::exists($viewPath))
            ->toBe(true, "File not created at expected path:\n".$viewPath."\nCommand result:\n".$result."\n\n");

    })->with('classes');

    it('should create blade file at Laravel configured path when view not set in laraca config', function (string $class) {
        Config::set('laraca.structure.component.path', 'Test/View/Components');
        Config::offsetUnset('laraca.structure.view');
        $this->artisan('make:component',
            ['name' => $class]);

        $result = Artisan::output();

        $snake_class = Str::snake($class, '-');
        $viewPath = base_path("resources/views/components/{$snake_class}.blade.php");

        expect(File::exists($viewPath))
            ->toBe(true, "File not created at expected path:\n".$viewPath."\nCommand result:\n".$result."\n\n");

    })->with('classes');
});

<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeRuleCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:rule', function () {
    it('should create Rule class at path from namespace', function (string $class) {
        $this->artisan(
            MakeRuleCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.rule.namespace'));
        $filePath = app_path("$configPath/$class.php");

        $result = Artisan::output();

        expect(File::exists(
            path: $filePath,
        ))->toBe(true, "File not created at expected path:\n".$filePath."\n".$result."\n\n");

    })->with('classes');

    it('should create a Rule class with the defined namespace', function (string $class) {
        $this->artisan(
            MakeRuleCommand::class,
            ['name' => $class],
        );

        $configPath = namespaceToPath(config('laraca.rule.namespace'));
        $configNamespace = fullNamespaceStr(config('laraca.rule.namespace'));

        expect(File::get(
            path: app_path("$configPath/$class.php")))->toContain($configNamespace);

    })->with('classes');
});

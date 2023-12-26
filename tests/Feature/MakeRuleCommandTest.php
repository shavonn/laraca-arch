<?php

use HandsomeBrown\Laraca\Foundation\Console\MakeRuleCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

describe('make:rule', function () {
    it('should create Rule class with namespace at path created from configured namespace', function (string $class) {
        $this->artisan(MakeRuleCommand::class,
            ['name' => $class]);

        $configPath = assemblePath('rule');
        $filePath = "$configPath/$class.php";

        $result = Artisan::output();

        expect(File::exists($filePath))
            ->toBe(true, "File not created at expected path:\n".$filePath."\nCommand result:\n".$result."\n\n");

        $configNamespace = fullNamespaceStr(assembleNamespace('rule'));

        expect(File::get($filePath))
            ->toContain($configNamespace);

    })->with('classes');
});

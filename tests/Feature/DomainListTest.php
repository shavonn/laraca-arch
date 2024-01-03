<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Exception\InvalidOptionException;

use function Pest\Laravel\artisan;

describe('domain:list', function () {
    it('should list direct children of the configured domain folder', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'TestDomains');

        artisan('make:controller', ['name' => $class, '--domain' => $domain]);

        artisan('make:job', ['name' => $class, '--domain' => $domain]);

        artisan('domain:list');
        $output = Artisan::output();

        $class = ucfirst($class);
        $domain = ucfirst($domain);

        expect($output)
            ->toContain('TestDomains', $domain);
    })->with('classes', 'domains');

    it('should not be available when domains are disabled', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', false);
        Config::set('laraca.struct.domain.path', 'TestDomains');

        artisan('make:controller', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        expect($output)
            ->not->toContain('domain:list');
    })->with('classes', 'domains')->throws(InvalidOptionException::class);
});

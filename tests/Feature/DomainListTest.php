<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

describe('domain:list', function () {
    it('should list direct children of the configured domain folder', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'TestDomains');
        $this->artisan('make:controller',
            ['name' => $class,
                'domain' => $domain]);
        $this->artisan('make:job',
            ['name' => $class,
                'domain' => $domain]);

        $this->artisan('domain:list');

        $output = Artisan::output();
        expect($output)
            ->toContain('TestDomains', ucfirst($domain));

    })->with('classes', 'domains');

    it('should not be available when domains are disabled', function () {
        Config::set('laraca.struct.domain.enabled', false);
        Config::set('laraca.struct.domain.path', 'TestDomains');
        $output = Artisan::output();
        expect($output)
            ->not->toContain('domain:list');
    });

    it('should not be available when domain parent dir is null', function () {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', null);
        $output = Artisan::output();
        expect($output)
            ->not->toContain('domain:list');
    });
});

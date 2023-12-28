<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

describe('domain:list', function () {
    it('should list direct children of the configured domain folder', function (string $class, string $domain) {
        Config::set('laraca.domains.enabled', true);
        Config::set('laraca.domains.parent_dir', 'TestDomains');
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
        Config::set('laraca.domains.enabled', false);
        Config::set('laraca.domains.parent_dir', 'TestDomains');
        $output = Artisan::output();
        expect($output)
            ->not->toContain('domain:list');
    });

    it('should not be available when domain parent dir is null', function () {
        Config::set('laraca.domains.enabled', true);
        Config::set('laraca.domains.parent_dir', null);
        $output = Artisan::output();
        expect($output)
            ->not->toContain('domain:list');
    });
});

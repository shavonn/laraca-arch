<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Pest\Laravel\artisan;

describe('arti:migration', function () {
    it('should create Migration in config path', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('arti:migration', ['name' => $class]);
        $output = Artisan::output();

        $now = now();
        $subSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $now = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);

        $migrationsPath = base_path('test/database/migrations');

        // account for second change variation that may occur in file name
        $migrationPath1 = "$migrationsPath/{$subSecond}_{$snake_class}.php";
        $migrationPath2 = "$migrationsPath/{$now}_{$snake_class}.php";

        expect(File::exists($migrationPath1) || File::exists($migrationPath2))
            ->toBe(true, "File not created at expected path:\n$migrationPath1\n$migrationPath2\n$output\n\n");
    })->with('classes');

    it('should create Migration in path option', function (string $class) {
        Config::set('laraca.struct.database.path', 'test/database');

        artisan('arti:migration', ['name' => $class, '--path' => 'test/db/migrations']);
        $output = Artisan::output();

        $now = now();
        $subSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $now = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);

        $migrationsPath = base_path('test/db/migrations');

        // account for second change variation that may occur in file name
        $migrationPath1 = "$migrationsPath/{$subSecond}_{$snake_class}.php";
        $migrationPath2 = "$migrationsPath/{$now}_{$snake_class}.php";

        expect(File::exists($migrationPath1) || File::exists($migrationPath2))
            ->toBe(true, "File not created at expected path:\n$migrationPath1\n$migrationPath2\n$output\n\n");

    })->with('classes');

    it('should create Migration and test in config path with domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('arti:migration', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $domain = getName($domain);

        $now = now();
        $subSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $now = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);

        $migrationsPath = app_path("Test/Domains/$domain/database/migrations");

        // account for second change variation that may occur in file name
        $migrationPath1 = "$migrationsPath/{$subSecond}_{$snake_class}.php";
        $migrationPath2 = "$migrationsPath/{$now}_{$snake_class}.php";

        expect(File::exists($migrationPath1) || File::exists($migrationPath2))
            ->toBe(true, "File not created at expected path:\n$migrationPath1\n$migrationPath2\n$output\n\n");
    })->with('classes', 'domains');

    it('should create Migration and test in config path with service', function (string $class, string $service) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('arti:migration', ['name' => $class, '--service' => $service]);
        $output = Artisan::output();

        $service = getName($service);

        $now = now();
        $subSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $now = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);

        $migrationsPath = app_path("Test/Services/$service/database/migrations");

        // account for second change variation that may occur in file name
        $migrationPath1 = "$migrationsPath/{$subSecond}_{$snake_class}.php";
        $migrationPath2 = "$migrationsPath/{$now}_{$snake_class}.php";

        expect(File::exists($migrationPath1) || File::exists($migrationPath2))
            ->toBe(true, "File not created at expected path:\n$migrationPath1\n$migrationPath2\n$output\n\n");
    })->with('classes', 'domains');

    it('should create Migration and test in config path with domain service', function (string $class, string $domain, string $service) {
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('arti:migration', ['name' => $class, '--domain' => $domain, '--service' => $service]);
        $output = Artisan::output();

        $domain = getName($domain);
        $service = getName($service);

        $now = now();
        $subSecond = $now->copy()->subSecond()->format('Y_m_d_His');
        $now = $now->format('Y_m_d_His');

        $snake_class = Str::snake($class);

        $migrationsPath = app_path("Test/Domains/$domain/Services/$service/database/migrations");

        // account for second change variation that may occur in file name
        $migrationPath1 = "$migrationsPath/{$subSecond}_{$snake_class}.php";
        $migrationPath2 = "$migrationsPath/{$now}_{$snake_class}.php";

        expect(File::exists($migrationPath1) || File::exists($migrationPath2))
            ->toBe(true, "File not created at expected path:\n$migrationPath1\n$migrationPath2\n$output\n\n");
    })->with('classes', 'domains', 'domains');
});

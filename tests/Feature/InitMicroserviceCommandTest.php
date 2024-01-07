<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Exception\InvalidOptionException;

use function Pest\Laravel\artisan;

describe('init:micro', function () {
    it('should init microservice dirs and files', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('init:micro', ['name' => $class]);
        $output = Artisan::output();

        $class = getName($class);
        $slug = Str::slug($class);

        $paths = [
            "app/Test/Services/$class/Broadcasting",
            "app/Test/Services/$class/Http/Controllers",
            "app/Test/Services/$class/Providers",
            "app/Test/Services/$class/resources/views",
            "app/Test/Services/$class/routes",
            "app/Test/Services/$class/tests",
        ];

        foreach ($paths as $p) {
            $dirPath = base_path($p);
            expect(File::isDirectory($dirPath))
                ->toBe(true, "Directory not created:\n".$dirPath."\n");
        }

        $root = app_path("Test/Services/$class/");

        $serviceProviderPath = "$root{$class}ServiceProvider.php";
        expect($serviceProviderPath)
            ->toBeFile("File not created at expected path:\n$serviceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($serviceProviderPath))->toContain(
            "namespace App\Test\Services\\$class;",
            "class $class",
        );

        $routeServiceProviderPath = "{$root}Providers/RouteServiceProvider.php";
        expect($routeServiceProviderPath)
            ->toBeFile("File not created at expected path:\n$routeServiceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($routeServiceProviderPath))->toContain(
            "namespace App\Test\Services\\$class\Providers;",
            'class RouteServiceProvider',
            'require __DIR__.\'/../routes/web.php\';',
        );

        $broadcastServiceProviderPath = "{$root}Providers/BroadcastServiceProvider.php";
        expect($broadcastServiceProviderPath)
            ->toBeFile("File not created at expected path:\n$broadcastServiceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($broadcastServiceProviderPath))->toContain(
            "namespace App\Test\Services\\$class\Providers;",
            'class BroadcastServiceProvider',
            'require __DIR__.\'/../routes/channels.php\';',
        );

        $routesPath = "{$root}routes/";
        $webPath = "{$routesPath}web.php";
        expect($webPath)
            ->toBeFile("File not created at expected path:\n$webPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($webPath))->toContain(
            "prefix: /$slug"
        );

        $apiPath = "{$routesPath}api.php";
        expect($apiPath)
            ->toBeFile("File not created at expected path:\n$apiPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($apiPath))->toContain(
            "/api/$slug"
        );

        $channelsPath = "{$routesPath}channels.php";
        expect($channelsPath)
            ->toBeFile("File not created at expected path:\n$channelsPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($channelsPath))->toContain(
            "Broadcast::channel('$class.User.{id}', function (\$user, \$id) {"
        );

        $welcomePath = "{$root}resources/views/welcome.blade.php";
        expect($welcomePath)
            ->toBeFile("File not created at expected path:\n$welcomePath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($welcomePath))->toContain(
            'Enjoy your new Laraca generated service'
        );
    })->with('classes');

    it('should not allow an existing microservice to be created', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('init:micro', ['name' => $class]);
        artisan('init:micro', ['name' => $class]);
        $output = Artisan::output();

        expect($output)->toContain('already exists');
    })->with('classes');

    it('should init microservice dirs and files in domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('init:micro', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = getName($class);
        $domain = getName($domain);

        $serviceProviderPath = app_path("Test/Domains/$domain/Services/$class/{$class}ServiceProvider.php");

        expect($serviceProviderPath)
            ->toBeFile("File not created at expected path:\n$serviceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($serviceProviderPath))->toContain(
            "namespace App\Test\Domains\\$domain\Services\\$class;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should not create a microservice with service flag', function () {
        Config::set('laraca.struct.microservice.enabled', true);
        Config::set('laraca.struct.microservice.path', 'Test/Services');

        artisan('init:micro', ['name' => 'FooCreated', '--service' => 'Bar']);

    })->throws(InvalidOptionException::class);
});

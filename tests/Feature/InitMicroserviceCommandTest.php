<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Exception\InvalidOptionException;

use function Pest\Laravel\artisan;

describe('init:micro', function () {
    it('should implement microservice with selected elements', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Microservices');

        artisan('init:micro', ['name' => $class]);

        $output = Artisan::output();

        $class = ucfirst($class);
        $slug = Str::slug($class);

        $paths = [
            "app/Test/Microservices/$class/Broadcasting",
            "app/Test/Microservices/$class/Http/Controllers",
            "app/Test/Microservices/$class/Providers",
            "app/Test/Microservices/$class/resources/views",
            "app/Test/Microservices/$class/routes",
            "app/Test/Microservices/$class/tests",
        ];

        foreach ($paths as $p) {
            $dirPath = base_path($p);
            expect(File::isDirectory($dirPath))
                ->toBe(true, "Directory not created:\n".$dirPath."\n");
        }

        $root = app_path("Test/Microservices/$class/");

        $serviceProviderPath = "$root{$class}ServiceProvider.php";
        expect($serviceProviderPath)
            ->toBeFile("File not created at expected path:\n$serviceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($serviceProviderPath))->toContain(
            "namespace App\Test\Microservices\\$class;",
            "class $class",
        );

        $routeServiceProviderPath = "{$root}Providers/RouteServiceProvider.php";
        expect($routeServiceProviderPath)
            ->toBeFile("File not created at expected path:\n$routeServiceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($routeServiceProviderPath))->toContain(
            "namespace App\Test\Microservices\\$class\Providers;",
            'class RouteServiceProvider',
            'require __DIR__.\'/../routes/web.php\';',
        );

        $broadcastServiceProviderPath = "{$root}Providers/BroadcastServiceProvider.php";
        expect($broadcastServiceProviderPath)
            ->toBeFile("File not created at expected path:\n$broadcastServiceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($broadcastServiceProviderPath))->toContain(
            "namespace App\Test\Microservices\\$class\Providers;",
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

    it('should not allow the same microservice to be created twice', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Microservices');

        artisan('init:micro', ['name' => $class]);

        artisan('init:micro', ['name' => $class]);
        $output = Artisan::output();

        expect($output)->toContain('already exists');
    })->with('classes');

    it('should create microservice in domain', function (string $class, string $domain) {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('init:micro', ['name' => $class, '--domain' => $domain]);
        $output = Artisan::output();

        $class = ucfirst($class);
        $domain = ucfirst($domain);

        $serviceProviderPath = app_path("Test/Domains/$domain/Microservices/$class/{$class}ServiceProvider.php");
        expect($serviceProviderPath)
            ->toBeFile("File not created at expected path:\n$serviceProviderPath\n\nOutput results:\n$output\n=====\n");

        expect(File::get($serviceProviderPath))->toContain(
            "namespace App\Test\Domains\\$domain\Microservices\\$class;",
            "class $class",
        );
    })->with('classes', 'domains');

    it('should not create a service with service flag', function () {
        Config::set('laraca.struct.domain.enabled', true);
        Config::set('laraca.struct.domain.path', 'Test/Domains');

        artisan('init:micro', ['name' => 'FooCreated', '--service' => 'Bar']);

    })->throws(InvalidOptionException::class);
});

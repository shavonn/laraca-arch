<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('init:micro', function () {
    it('should implement microservice with selected elements', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Microservices');
        Config::set('laraca.struct.microservice.elements', [
            'command',
            'channel',
            'controller',
            'job',
            'middleware',
            'provider',
            'route',
            'test',
            'view',
        ]);
        expect($this->artisan('init:micro', [
            'name' => $class,
        ]))->toBe(0);

        $output = Artisan::output();

        $class = ucfirst($class);
        $slug = Str::slug(ucfirst($class));

        $paths = [
            "app/Test/Microservices/$class/Broadcasting",
            "app/Test/Microservices/$class/Console/Commands",
            "app/Test/Microservices/$class/Http/Controllers",
            "app/Test/Microservices/$class/Http/Middleware",
            "app/Test/Microservices/$class/Jobs",
            "app/Test/Microservices/$class/Providers",
            "app/Test/Microservices/$class/resources/views",
            "app/Test/Microservices/$class/routes",
            "app/Test/Microservices/$class/tests",
        ];

        foreach ($paths as $p) {
            $dirPath = base_path($p);
            expect(File::isDirectory($dirPath))
                ->toBe(true, "Directory not created:\n".$dirPath."\n");

            $servicePath = app_path("Test/Microservices/$class/".$class.'ServiceProvider.php');
            $routeServicePath = app_path("Test/Microservices/$class/Providers/RouteServiceProvider.php");
            $broadcastServicePath = app_path("Test/Microservices/$class/Providers/BroadcastServiceProvider.php");
            $welcomePath = app_path("Test/Microservices/$class/resources/views/welcome.blade.php");
            $routesPath = app_path("Test/Microservices/$class/routes/");

            $serviceNamespace = fullNamespaceStr("App\\Test\\Microservices\\$class");
            $providerNamespace = fullNamespaceStr("App\\Test\\Microservices\\$class\\Providers");

            expect(File::exists($servicePath))
                ->toBe(true, "File not created at expected path:\n".$servicePath."\nCommand result:\n".$output."\n\n");

            expect(File::get($servicePath))
                ->toContain($serviceNamespace);

            expect(File::exists($routeServicePath))
                ->toBe(true, "File not created at expected path:\n".$routeServicePath."\nCommand result:\n".$output."\n\n");
            expect(File::get($routeServicePath))
                ->toContain($providerNamespace)
                ->toContain('require __DIR__.\'/../routes/web.php\';');

            expect(File::exists($broadcastServicePath))
                ->toBe(true, "File not created at expected path:\n".$broadcastServicePath."\nCommand result:\n".$output."\n\n");
            expect(File::get($broadcastServicePath))
                ->toContain($providerNamespace)
                ->toContain('require __DIR__.\'/../routes/channels.php\';');

            expect(File::exists($routesPath.'web.php'))
                ->toBe(true, "File not created at expected path:\n".$routesPath.'web.php'."\nCommand result:\n".$output."\n\n");
            expect(File::get($routesPath.'web.php'))
                ->toContain($slug)
                ->toContain("prefix: /$slug");

            expect(File::exists($routesPath.'api.php'))
                ->toBe(true, "File not created at expected path:\n".$routesPath.'api.php'."\nCommand result:\n".$output."\n\n");
            expect(File::get($routesPath.'api.php'))
                ->toContain($slug)
                ->toContain("/api/$slug");

            expect(File::exists($routesPath.'channels.php'))
                ->toBe(true, "File not created at expected path:\n".$routesPath.'api.php'."\nCommand result:\n".$output."\n\n");
            expect(File::get($routesPath.'channels.php'))
                ->toContain($class)
                ->toContain('Broadcast::channel(\''.$class.'.User.{id}\', function ($user, $id) {');

            expect(File::exists($welcomePath))
                ->toBe(true, "File not created at expected path:\n".$welcomePath."\nCommand result:\n".$output."\n\n");
        }
    })->with('classes');

    it('should implement microservice without broadcast provider', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Microservices');
        Config::set('laraca.struct.microservice.elements', [
            'provider',
            'route',
            'view',
        ]);
        expect($this->artisan('init:micro', [
            'name' => $class,
        ]))->toBe(0);

        $output = Artisan::output();

        $class = ucfirst($class);

        $paths = [
            "app/Test/Microservices/$class/Providers",
            "app/Test/Microservices/$class/resources/views",
            "app/Test/Microservices/$class/routes",
        ];

        foreach ($paths as $p) {
            $dirPath = base_path($p);
            expect(File::isDirectory($dirPath))
                ->toBe(true, "Directory not created:\n".$dirPath."\n");

            $servicePath = app_path("Test/Microservices/$class/".$class.'ServiceProvider.php');
            $routeServicePath = app_path("Test/Microservices/$class/Providers/RouteServiceProvider.php");
            $broadcastServicePath = app_path("Test/Microservices/$class/Providers/BroadcastServiceProvider.php");
            $welcomePath = app_path("Test/Microservices/$class/resources/views/welcome.blade.php");
            $routesPath = app_path("Test/Microservices/$class/routes/");

            $serviceNamespace = fullNamespaceStr("App\\Test\\Microservices\\$class");
            $providerNamespace = fullNamespaceStr("App\\Test\\Microservices\\$class\\Providers");

            expect(File::exists($servicePath))
                ->toBe(true, "File not created at expected path:\n".$servicePath."\nCommand result:\n".$output."\n\n");

            expect(File::get($servicePath))
                ->toContain($serviceNamespace);

            expect(File::exists($routeServicePath))
                ->toBe(true, "File not created at expected path:\n".$routeServicePath."\nCommand result:\n".$output."\n\n");
            expect(File::get($routeServicePath))
                ->toContain($providerNamespace)
                ->toContain('require __DIR__.\'/../routes/web.php\';');

            expect(! File::exists($broadcastServicePath))
                ->toBe(true, "File should not have been generated:\n".$broadcastServicePath."\nCommand result:\n".$output."\n\n");

            expect(! File::exists($routesPath.'channels.php'))
                ->toBe(true, "File should not have been generated:\n".$routesPath.'api.php'."\nCommand result:\n".$output."\n\n");

            expect(File::exists($welcomePath))
                ->toBe(true, "File not created at expected path:\n".$welcomePath."\nCommand result:\n".$output."\n\n");
        }
    })->with('classes');

    it('should implement microservice without route/broadcast providers or route files', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Microservices');
        Config::set('laraca.struct.microservice.elements', [
            'command',
            'provider',
            'test',
        ]);
        expect($this->artisan('init:micro', [
            'name' => $class,
        ]))->toBe(0);

        $output = Artisan::output();

        $class = ucfirst($class);

        $paths = [
            "app/Test/Microservices/$class/Console/Commands",
            "app/Test/Microservices/$class/Providers",
            "app/Test/Microservices/$class/tests",
        ];

        foreach ($paths as $p) {
            $dirPath = base_path($p);
            expect(File::isDirectory($dirPath))
                ->toBe(true, "Directory not created:\n".$dirPath."\n");

            $servicePath = app_path("Test/Microservices/$class/".$class.'ServiceProvider.php');
            $routeServicePath = app_path("Test/Microservices/$class/Providers/RouteServiceProvider.php");
            $broadcastServicePath = app_path("Test/Microservices/$class/Providers/BroadcastServiceProvider.php");
            $routesPath = app_path("Test/Microservices/$class/routes/");
            $welcomePath = app_path("Test/Microservices/$class/resources/views/welcome.blade.php");

            $serviceNamespace = fullNamespaceStr("App\\Test\\Microservices\\$class");

            expect(File::exists($servicePath))
                ->toBe(true, "File not created at expected path:\n".$servicePath."\nCommand result:\n".$output."\n\n");

            expect(File::get($servicePath))
                ->toContain($serviceNamespace)
                ->not->toContain('BroadcastServicProvider')
                ->not->toContain('RouteServiceProvider');

            expect(! File::exists($routeServicePath))
                ->toBe(true, "File should not have been generated:\n".$routeServicePath."\nCommand result:\n".$output."\n\n");

            expect(! File::exists($broadcastServicePath))
                ->toBe(true, "File should not have been generated:\n".$broadcastServicePath."\nCommand result:\n".$output."\n\n");

            expect(! File::exists($routesPath.'web.php'))
                ->toBe(true, "File should not have been generated:\n".$routesPath.'web.php'."\nCommand result:\n".$output."\n\n");

            expect(! File::exists($routesPath.'api.php'))
                ->toBe(true, "File should not have been generated:\n".$routesPath.'api.php'."\nCommand result:\n".$output."\n\n");

            expect(! File::exists($routesPath.'channels.php'))
                ->toBe(true, "File should not have been generated:\n".$routesPath.'api.php'."\nCommand result:\n".$output."\n\n");

            expect(! File::exists($welcomePath))
                ->toBe(true, "File should not have been generated:\n".$welcomePath."\nCommand result:\n".$output."\n\n");
        }
    })->with('classes');
});

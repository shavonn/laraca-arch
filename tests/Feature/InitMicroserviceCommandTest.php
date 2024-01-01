<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

describe('init:micro', function () {
    it('should implement microservice with selected elements', function (string $class) {
        Config::set('laraca.struct.microservice.path', 'Test/Microservices');
        expect($this->artisan('init:micro', [
            'name' => $class,
        ]))->toBe(0);

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

        $root = "Test/Microservices/$class";
        $servicePath = app_path($root.'/'.$class.'ServiceProvider.php');
        $routeServicePath = app_path("$root/Providers/RouteServiceProvider.php");
        $broadcastServicePath = app_path("$root/Providers/BroadcastServiceProvider.php");
        $welcomePath = app_path("$root/resources/views/welcome.blade.php");
        $routesPath = app_path("$root/routes/");

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
    })->with('classes');
});
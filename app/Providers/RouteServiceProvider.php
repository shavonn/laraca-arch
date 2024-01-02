<?php

namespace App\Microservices\FooCreated\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app['router']->group([
            'middleware' => 'web',
            'prefix' => 'foocreated',
            'namespace' => 'App\Microservices\FooCreated\Http\Controllers',
        ], function () {
            require __DIR__.'/../routes/web.php';
        });

        $this->app['router']->group([
            'middleware' => 'api',
            'prefix' => 'api/foocreated',
            'namespace' => 'App\Microservices\FooCreated\Http\Controllers',
        ], function () {
            require __DIR__.'/../routes/api.php';
        });
    }
}

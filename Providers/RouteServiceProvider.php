<?php

namespace App\Test\Microservices\PackageClass\Providers;

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
            'prefix' => 'packageclass',
            'namespace' => 'App\Test/Microservices\PackageClass\Http\Controllers',
        ], function () {
            require __DIR__.'/../routes/web.php';
        });

        $this->app['router']->group([
            'middleware' => 'api',
            'prefix' => 'api/packageclass',
            'namespace' => 'App\Test/Microservices\PackageClass\Http\Controllers',
        ], function () {
            require __DIR__.'/../routes/api.php';
        });
    }
}

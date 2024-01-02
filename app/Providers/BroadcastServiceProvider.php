<?php

namespace App\Microservices\FooCreated\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        require __DIR__.'/../routes/channels.php';
    }
}

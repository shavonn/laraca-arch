<?php

namespace HandsomeBrown\Laraca\Tests;

use HandsomeBrown\Laraca\LaracaServiceProvider;

class LaracaTestServiceProvider extends LaracaServiceProvider
{
    /**
     * register
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.test.php', 'laraca');
    }
}

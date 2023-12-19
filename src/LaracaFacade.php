<?php

namespace HandsomeBrown\Laraca;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HandsomeBrown\Laraca\Skeleton\SkeletonClass
 */
class LaracaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraca';
    }
}

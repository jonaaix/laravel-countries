<?php

namespace Aaix\LaravelCountries\Facades;

use Aaix\LaravelCountries\Skeleton\SkeletonClass;
use Illuminate\Support\Facades\Facade;

/**
 * @see SkeletonClass
 */
class WCountries extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'w-countries';
    }
}

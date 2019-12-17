<?php

namespace Ghost\GhostAuth\Facades;

use Ghost\GhostAuth\Contracts\Factory;
use Illuminate\Support\Facades\Facade;


/**
 * @method static \Ghost\GhostAuth\Contracts\Provider driver(string $driver = null)
 * @see \Ghost\GhostAuth\GhostManager
 */
class GhostAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}

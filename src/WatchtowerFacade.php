<?php

namespace Smarch\Watchtower;

use Illuminate\Support\Facades\Facade;

class WatchtowerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'watchtower';
    }
}

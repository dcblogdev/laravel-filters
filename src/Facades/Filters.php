<?php

namespace Dcblogdev\Filters\Facades;

use Illuminate\Support\Facades\Facade;

class Filters extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'filters';
    }
}

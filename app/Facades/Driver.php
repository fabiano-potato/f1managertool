<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Driver
 * @package App\Facades
 */
class Driver extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Driver';
    }
}

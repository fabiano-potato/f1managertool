<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class DriverLevel
 * @package App\Facades
 */
class DriverLevel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DriverLevel';
    }
}

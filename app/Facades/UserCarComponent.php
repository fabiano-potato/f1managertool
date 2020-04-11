<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserCarComponent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserCarComponent';
    }
}

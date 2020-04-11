<?php

namespace App\Facades;

use App\Contracts\Repositories\CarComponentRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class CarComponent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CarComponent';
    }
}

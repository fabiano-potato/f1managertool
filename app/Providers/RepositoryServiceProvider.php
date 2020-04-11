<?php

namespace App\Providers;

use App\Contracts\Repositories\CarComponentRepositoryInterface;
use App\Repositories\Eloquent\CarComponentLevelRepository;
use App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use App\Repositories\Eloquent\CarComponentRepository;
use App\Repositories\Eloquent\UserCarComponentRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        // Facade bindings
        'CarComponent' => CarComponentRepository::class,
        'CarComponentLevel' => CarComponentLevelRepository::class,
        'UserCarComponent' => UserCarComponentRepository::class,
    ];
}

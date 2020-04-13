<?php

namespace App\Providers;

use App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use App\Contracts\Repositories\CarComponentRepositoryInterface;
use App\Contracts\Repositories\DriverLevelRepositoryInterface;
use App\Contracts\Repositories\DriverRepositoryInterface;
use App\Contracts\Repositories\UserCarComponentRepositoryInterface;
use App\Repositories\Eloquent\CarComponentLevelRepository;
use App\Repositories\Eloquent\CarComponentRepository;
use App\Repositories\Eloquent\UserCarComponentRepository;
use App\Repositories\Eloquent\DriverRepository;
use App\Repositories\Eloquent\DriverLevelRepository;
use App\Services\CarComponents\CarComponentUpgrader;
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
        // Repository bindings
        CarComponentRepositoryInterface::class => CarComponentRepository::class,
        CarComponentLevelRepositoryInterface::class => CarComponentLevelRepository::class,
        DriverRepositoryInterface::class => DriverRepository::class,
        DriverLevelRepositoryInterface::class => DriverLevelRepository::class,
        UserCarComponentRepositoryInterface::class => UserCarComponentRepository::class,

        // Service class bindings
        CarComponentUpgrader::class => CarComponentUpgrader::class,
    ];
}

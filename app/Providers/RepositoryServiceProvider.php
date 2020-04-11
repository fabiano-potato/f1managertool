<?php

namespace App\Providers;

use App\Repositories\Eloquent\CarComponentLevelRepository;
use App\Repositories\Eloquent\CarComponentRepository;
use App\Repositories\Eloquent\UserCarComponentRepository;
use App\Repositories\Eloquent\DriverRepository;
use App\Repositories\Eloquent\DriverLevelRepository;
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
        'Driver' => DriverRepository::class,
        'DriverLevel' => DriverLevelRepository::class,
        'UserCarComponent' => UserCarComponentRepository::class,
    ];
}

<?php

namespace App\Providers;

use App\Repositories\Eloquent\CarComponentLevelRepository;
use App\Repositories\CarComponentLevelRepositoryInterface;
use App\Models\Eloquent\EloquentCarComponentLevelModel;
use App\Models\Eloquent\EloquentCarComponentModel;
use App\Models\Mappers\Eloquent\CarComponentLevelMapper;
use App\Models\Mappers\CarComponentLevelMapperInterface;
use App\Models\Mappers\Eloquent\CarComponentMapper;
use App\Models\Mappers\CarComponentMapperInterface;
use App\Repositories\Eloquent\CarComponentRepository;
use App\Repositories\CarComponentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the repository classes
     *
     * @return  void
     */
    public function register()
    {
        parent::register();

        // Bind the car component repository and mapper
        $this->app->bind(CarComponentMapperInterface::class, CarComponentMapper::class);
        $this->app->bind(CarComponentRepositoryInterface::class, function(){
            return new CarComponentRepository(new CarComponentMapper(), new EloquentCarComponentModel());
        });

        // Bind the car component level repository and mapper
        $this->app->bind(CarComponentLevelMapperInterface::class, CarComponentLevelMapper::class);
        $this->app->bind(CarComponentLevelRepositoryInterface::class, function(){
            return new CarComponentLevelRepository(new CarComponentLevelMapper(), new EloquentCarComponentLevelModel());
        });
    }
}

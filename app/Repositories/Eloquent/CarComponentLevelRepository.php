<?php

namespace App\Repositories\Eloquent;

use \App\Models\Mappers\CarComponentLevelMapperInterface;
use \App\Repositories\CarComponentRepositoryInterface;
use \App\Models\Eloquent\EloquentCarComponentLevelModel;

/**
 * Class CarComponentLevelRepository
 * @package App\Repositories\Eloquent
 */
class CarComponentLevelRepository extends AbstractEloquentRepository implements CarComponentRepositoryInterface
{
    /**
     * CarComponentRepository constructor.
     * @param CarComponentLevelMapperInterface $mapper
     * @param EloquentCarComponentLevelModel $model
     */
    public function __construct(CarComponentLevelMapperInterface $mapper, EloquentCarComponentLevelModel $model)
    {
        $this->_mapper = $mapper;
        $this->_model = $model;
    }
}

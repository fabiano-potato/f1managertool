<?php

namespace App\Repositories\Eloquent;

use App\Models\Entities\AbstractEntity;
use \App\Models\Entities\CarComponentEntity;
use \App\Models\Mappers\CarComponentMapperInterface;
use \App\Repositories\CarComponentRepositoryInterface;
use \App\Models\Eloquent\EloquentCarComponentModel;

/**
 * Class CarComponentRepository
 * @package App\Repositories\Eloquent
 */
class CarComponentRepository extends AbstractEloquentRepository implements CarComponentRepositoryInterface
{
    /**
     * CarComponentRepository constructor.
     * @param CarComponentMapperInterface $mapper
     * @param EloquentCarComponentModel $model
     */
    public function __construct(CarComponentMapperInterface $mapper, EloquentCarComponentModel $model)
    {
        $this->_mapper = $mapper;
        $this->_model = $model;
    }
}

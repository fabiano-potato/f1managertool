<?php

namespace App\Repositories\Eloquent;

use App\Models\Entities\CarComponentLevelEntity;
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
     * @param CarComponentLevelEntity $entity
     */
    public function __construct(
        CarComponentLevelMapperInterface $mapper,
        EloquentCarComponentLevelModel $model,
        CarComponentLevelEntity $entity
    ) {
        $this->_mapper = $mapper;
        $this->_modelPrototype = $model;
        $this->_entityPrototype = $entity;
    }
}

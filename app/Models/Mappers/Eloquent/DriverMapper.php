<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Eloquent\EloquentDriverModel;
use App\Models\Entities\DriverEntity;

/**
 * Class DriverMapper
 * @package App\Models\Mappers\Eloquent
 */
Class DriverMapper extends AbstractEloquentMapper
{
    /**
     * A map of Entity property names to model property names
     *
     * @var array
     */
    protected static $_entityModelPropertyMap = [
        'driverId' => 'driver_id',
        'name' => 'name',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    /**
     * Map the model to entity
     *
     * @param EloquentDriverModel $model
     * @param DriverEntity $entity
     * @return DriverEntity
     */
    public function toEntity(EloquentDriverModel $model, DriverEntity $entity = null): DriverEntity
    {
        if (!$entity) {
            $entity = new DriverEntity();
        }
        /* @var DriverEntity $entity */
        $entity = parent::_toEntity($model, $entity);
        return $entity;
    }

    /**
     * Convert a Driver to an EloquentDriverModel
     *
     * @param DriverEntity $entity
     * @return EloquentDriverModel
     */
    public function toModel(DriverEntity $entity): EloquentDriverModel
    {
        /* @var EloquentDriverModel $model */
        $model = parent::_toModel($entity, new EloquentDriverModel());
        return $model;
    }
}

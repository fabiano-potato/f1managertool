<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Eloquent\EloquentCarComponentModel;
use App\Models\Entities\CarComponentEntity;

/**
 * Class CarComponentMapper
 * This class maps the eloquent model to it's entity and vice versa.
 *
 * @package App\Models\Eloquent\Mappers
 */
class CarComponentMapper extends AbstractEloquentMapper
{
    /**
     * A map of Entity property names to model property names
     *
     * @var array
     */
    protected static $_entityModelPropertyMap = [
        'carComponentId' => 'car_component_id',
        'name' => 'name',
        'type' => 'type',
        'createdAt' => 'created_at',
        'updateAt' => 'updated_at',
    ];

    /**
     * Map the model to entity
     *
     * @param EloquentCarComponentModel $model
     * @param CarComponentEntity|null $entity
     * @return CarComponentEntity
     */
    public function toEntity(EloquentCarComponentModel $model, CarComponentEntity $entity = null): CarComponentEntity
    {
        if (!$entity) {
            $entity = new CarComponentEntity();
        }
        return parent::_toEntity($model, $entity);
    }
}

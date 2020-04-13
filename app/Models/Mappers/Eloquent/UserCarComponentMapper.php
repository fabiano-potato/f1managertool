<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Eloquent\EloquentUserCarComponentModel;
use App\Models\Entities\UserCarComponentEntity;

/**
 * Class UserCarComponentsMapper
 * @package App\Models\Mappers\Eloquent
 */
Class UserCarComponentMapper extends AbstractEloquentMapper
{
    /**
     * A map of Entity property names to model property names
     *
     * @var array
     */
    protected static $_entityModelPropertyMap = [
        'userCarComponentsId' => 'user_car_components_id',
        'userId' => 'user_id',
        'carComponentType' => 'car_component_type',
        'carComponentId' => 'car_component_id',
        'currentUpgradePoints' => 'current_upgrade_points',
        'currentLevel' => 'current_level',
        'isAssigned' => 'is_assigned',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

    /**
     * Map the model to entity
     *
     * @param EloquentUserCarComponentModel $model
     * @param UserCarComponentEntity $entity
     * @return UserCarComponentEntity
     */
    public function toEntity(EloquentUserCarComponentModel $model, UserCarComponentEntity $entity = null): UserCarComponentEntity
    {
        if (!$entity) {
            $entity = new UserCarComponentEntity();
        }
        /* @var UserCarComponentEntity $entity */
        $entity = parent::_toEntity($model, $entity);
        return $entity;
    }

    /**
     * Convert a UserCarComponentEntity to an EloquentUserCarComponentModel
     *
     * @param UserCarComponentEntity $entity
     * @return EloquentUserCarComponentModel
     */
    public function toModel(UserCarComponentEntity $entity): EloquentUserCarComponentModel
    {
        /* @var EloquentUserCarComponentModel $model */
        $model = parent::_toModel($entity, new EloquentUserCarComponentModel());
        $model->is_assigned = $entity->isAssigned();
        return $model;
    }
}

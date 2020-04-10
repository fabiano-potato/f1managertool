<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Entities\AbstractEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class AbstractEloquentMapper
 * @package App\Models\Mappers\Eloquent
 */
abstract class AbstractEloquentMapper
{
    /**
     * A map of Entity property names to model property names
     *
     * @var array
     */
    protected static $_entityModelPropertyMap = [];

    /**
     * Map the Eloquent model to its entity
     *
     * @param Model $model
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    protected function _toEntity(Model $model, AbstractEntity $entity)
    {
        foreach (static::$_entityModelPropertyMap as $entityProp => $modelProp)
        {
            if ($model->$modelProp !== null) {
                $setterName = 'set' . ucfirst($entityProp);
                if (method_exists($entity, $setterName)) {
                    $entity->$setterName($model->$modelProp);
                }
            }
        }
        return $entity;
    }

    /**
     * Map the entity to an eloquent model
     *
     * @param AbstractEntity $entity
     * @param Model $model
     * @return Model
     */
    public function toModel(AbstractEntity $entity, Model $model): Model
    {
        foreach (static::$_entityModelPropertyMap as $entityProp => $modelProp)
        {
            $getterName = 'get' . ucfirst(Str::camel($entityProp));
            if (method_exists($entity, $getterName)) {
                $model->$modelProp = $entity->$getterName();
            }
        }
        return $model;
    }
}

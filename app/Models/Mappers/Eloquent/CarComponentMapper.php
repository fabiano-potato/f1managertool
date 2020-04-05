<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Eloquent\EloquentCarComponentModel;
use App\Models\Entities\AbstractEntity;
use App\Models\Mappers\CarComponentMapperInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entities\CarComponentEntity;

/**
 * Class CarComponentMapper
 * This class maps the eloquent model to it's entity and vice versa.
 *
 * @package App\Models\Eloquent\Mappers
 */
class CarComponentMapper implements CarComponentMapperInterface
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
    ];

    /**
     * Map the Eloquent model to it's entity
     *
     * @param Model $model
     * @return CarComponentEntity
     */
    public function toEntity(Model $model): CarComponentEntity
    {
        $entity = new CarComponentEntity();
        if ($model->car_component_id) {
            $entity->setCarComponentId($model->car_component_id);
        }
        if ($model->name) {
            $entity->setName($model->name);
        }
        if ($model->type) {
            $entity->setType($model->type);
        }
        return $entity;
    }

    /**
     * Map an array of models to an array of entities
     *
     * @param array $models
     * @return array
     */
    public function toEntities(array $models): array
    {
        $return = [];

        foreach ($models as $model) {
            $return[] = $this->toEntity($model);
        }

        return $return;
    }

    /**
     * Map the entity to an eloquent model
     *
     * @param AbstractEntity $entity
     * @return EloquentCarComponentModel
     */
    public function toModel(AbstractEntity $entity): Model
    {
        $model = new EloquentCarComponentModel();
        foreach (static::$_entityModelPropertyMap as $entityProp => $modelProp)
        {
            $getterName = 'get' . ucfirst($entityProp);
            $model->$modelProp = $entity->$getterName();
        }
        return $model;
    }
}

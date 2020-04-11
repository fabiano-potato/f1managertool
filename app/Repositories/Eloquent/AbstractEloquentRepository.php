<?php

namespace App\Repositories\Eloquent;

use App\Models\Mappers\Eloquent\AbstractEloquentMapper;
use App\Models\Entities\AbstractEntity;

abstract class AbstractEloquentRepository
{
    /**
     * @var AbstractEloquentMapper|null
     */
    protected $_mapper = null;

    /**
     * Create the entity
     *
     * @param AbstractEntity $entity
     * @return bool
     */
    protected function _create(&$entity): bool
    {
        // Ensure we creating from a new instance of model
        $model = $this->_mapper->toModel($entity);
        $result = $model->save();

        if ($result) {
            // Update the entity with saved model data (e.g primary key, timestamps)
            $entity = $this->_mapper->toEntity($model, $entity);
        }

        return $result;
    }
}

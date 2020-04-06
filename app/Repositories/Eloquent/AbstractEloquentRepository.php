<?php

namespace App\Repositories\Eloquent;

use App\Models\Mappers\MapperInterface;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entities\AbstractEntity;

abstract class AbstractEloquentRepository implements BaseRepositoryInterface
{
    /**
     * @var MapperInterface|null
     */
    protected $_mapper = null;

    /**
     * @var Model
     */
    protected $_modelPrototype = null;

    /**
     * @var AbstractEntity
     */
    protected $_entityPrototype = null;

    /**
     * @inheritDoc
     */
    public function find($filters = []): array
    {
        $results = $this->_modelPrototype->all();
        return $this->_mapper->toEntities($results);
    }

    /**
     * Find entity by its Id
     *
     * @param $id
     * @return null|AbstractEntity
     */
    public function findById($id)
    {
        $model = $this->_modelPrototype->find($id);
        if (!$model) {
            return null;
        }
        $entity = $this->_mapper->toEntity($model, clone $this->_entityPrototype);
        return $entity;
    }

    /**
     * Create the entity
     *
     * @param AbstractEntity $entity
     * @return bool
     */
    public function create(&$entity): bool
    {
        // Ensure we creating from a new instance of model
        $model = $this->_mapper->toModel($entity, clone $this->_modelPrototype);
        $result = $model->save();

        if ($result) {
            // Update the entity with saved model data (e.g primary key, timestamps)
            $entity = $this->_mapper->toEntity($model, $entity);
        }

        return $result;
    }
}

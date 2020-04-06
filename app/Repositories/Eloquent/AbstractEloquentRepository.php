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
    protected $_model = null;

    /**
     * @var AbstractEntity
     */
    protected $_entity = null;

    /**
     * @inheritDoc
     */
    public function find($filters = []): array
    {
        $results = $this->_model->all();
        return $this->_mapper->toEntities($results);
    }

    /**
     * Find entity by its Id
     *
     * @param $id
     * @return null|Model
     */
    public function findById($id)
    {
        $model = $this->_model->find($id);
        if (!$model) {
            return null;
        }
        $entity = $this->_mapper->toEntity($model, $this->_entity);
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
        $model = $this->_mapper->toModel($entity, clone $this->_model);
        $result = $model->save();

        if ($result) {
            // Update the entity with saved model data (e.g primary key, timestamps)
            $entity = $this->_mapper->toEntity($model, $entity);
        }

        return $result;
    }
}

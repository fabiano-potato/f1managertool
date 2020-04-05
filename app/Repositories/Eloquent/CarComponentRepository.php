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
class CarComponentRepository implements CarComponentRepositoryInterface
{
    /**
     * @var CarComponentMapperInterface|null
     */
    protected $_mapper = null;

    /**
     * @var EloquentCarComponentModel
     */
    protected $_model = null;

    /**
     * CarComponentRepository constructor.
     * @param CarComponentMapperInterface $_mapper
     */
    public function __construct(CarComponentMapperInterface $mapper, EloquentCarComponentModel $model)
    {
        $this->_mapper = $mapper;
        $this->_model = $model;
    }

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
     * @return null|CarComponentEntity
     */
    public function findById($id)
    {
        $model = EloquentCarComponentModel::find($id);
        if (!$model) {
            return null;
        }
        /* @var CarComponentEntity $entity */
        $entity = $this->_mapper->toEntity($model);
        return $entity;
    }

    /**
     * Create the entity
     *
     * @param AbstractEntity $entity
     * @return bool
     */
    public function create($entity): bool
    {
        $model = $this->_mapper->toModel($entity);
        return $model->save();
    }
}

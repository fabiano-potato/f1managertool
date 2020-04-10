<?php

namespace App\Repositories\Eloquent;

use App\Facades\CarComponentLevel;
use \App\Models\Entities\CarComponentEntity;
use \App\Contracts\Repositories\CarComponentRepositoryInterface;
use \App\Models\Eloquent\EloquentCarComponentModel;
use App\Models\Mappers\Eloquent\CarComponentMapper;

/**
 * Class CarComponentRepository
 * @package App\Repositories\Eloquent
 */
class CarComponentRepository extends AbstractEloquentRepository implements CarComponentRepositoryInterface
{
    /**
     * @var CarComponentMapper|null
     */
    protected $_mapper = null;

    /**
     * Whether to include and return the child CarComponentLevel entities
     *
     * @var bool
     */
    protected $_includeCarComponentLevels = false;

    /**
     * CarComponentRepository constructor.
     */
    public function __construct(){
        $this->_mapper = new CarComponentMapper();
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $entities = [];
        $results = EloquentCarComponentModel::all();
        foreach ($results as $carComponentModel)
        {
            $entities[] =$this->_mapToEntity($carComponentModel);
        }
        return $entities;
    }

    /**
     * Find entity by its Id
     *
     * @param $id
     * @return null|CarComponentEntity
     */
    public function findById($id): ?CarComponentEntity
    {
        $model = EloquentCarComponentModel::find($id);
        if (!$model) {
            return null;
        }
        return $this->_mapToEntity($model);
    }

    /**
     * Save a new entity
     *
     * @param CarComponentEntity $entity
     * @return bool
     */
    public function create(CarComponentEntity &$entity): bool
    {
        return $this->_create($entity);
    }

    /**
     * Returns an Entity for a given Model
     *
     * @param EloquentCarComponentModel $carComponentModel
     * @return CarComponentEntity
     */
    protected function _mapToEntity(EloquentCarComponentModel $carComponentModel): CarComponentEntity
    {
        /* @var CarComponentEntity $carComponentEntity */
        $carComponentEntity = $this->_mapper->toEntity($carComponentModel);
        if ($this->_includeCarComponentLevels) {
            $carComponentEntity->setCarComponentLevels(
                CarComponentLevel::findForCarComponent($carComponentEntity)
            );
        }

        return $carComponentEntity;
    }

    /**
     * Whether to include and return the child CarComponentLevel entities
     *
     * @param bool $include
     * @return self
     */
    public function includeCarComponentLevels($include = true): self
    {
        $this->_includeCarComponentLevels = $include;
        return $this;
    }
}

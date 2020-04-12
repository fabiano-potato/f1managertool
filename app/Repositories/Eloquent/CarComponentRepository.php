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
     * A list of active filters for query
     *
     * @var array
     */
    protected $_filters = [];

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
        if (empty($this->_filters)) {
            $results = EloquentCarComponentModel::all();
        }
        else {
            $query = EloquentCarComponentModel::query();

            // Add filters
            if (isset($this->_filters['car_component_id'])) {
                $this->_filter($query, 'car_component_id', $this->_filters['car_component_id']);
            }
            if (isset($this->_filters['type'])) {
                $this->_filter($query, 'type', $this->_filters['type']);
            }
            if (isset($this->_filters['not_car_component_id'])) {
                $this->_filterNot($query, 'car_component_id', $this->_filters['not_car_component_id']);
            }

            $results = $query->get();
        }

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
     * @return CarComponentRepository
     */
    public function includeCarComponentLevels(bool $include = true): self
    {
        $this->_includeCarComponentLevels = $include;
        return $this;
    }

    /**
     * Filter car components by their primary key
     *
     * @param array $ids
     * @return CarComponentRepository
     */
    public function filterCarComponentIds(array $ids): self
    {
        $this->_filters['car_component_id'] = $ids;
        return $this;
    }

    /**
     * Filter out car components by their primary key
     *
     * @param array $ids
     * @return CarComponentRepository
     */
    public function filterNotCarComponentIds(array $ids): self
    {
        $this->_filters['not_car_component_id'] = $ids;
        return $this;
    }

    /**
     * Filter query by car_component_type
     *
     * @param int $type
     * @return CarComponentRepository
     */
    public function filterType(int $type): self
    {
        $this->_filters['type'] = $type;
        return $this;
    }
}

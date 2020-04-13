<?php

namespace App\Repositories\Eloquent;

use App\Models\Entities\CarComponentEntity;
use \App\Models\Entities\CarComponentLevelEntity;
use \App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use \App\Models\Eloquent\EloquentCarComponentLevelModel;
use \App\Models\Mappers\Eloquent\CarComponentLevelMapper;

/**
 * Class CarComponentLevelRepository
 * @package App\Repositories\Eloquent
 */
class CarComponentLevelRepository extends AbstractEloquentRepository implements CarComponentLevelRepositoryInterface
{
    /**
     * @var CarComponentLevelMapper|null
     */
    protected $_mapper = null;

    /**
     * Filters for queries
     *
     * @var array
     */
    protected $_filters = [];

    /**
     * Whether to include and return the parent CarComponent
     *
     * @var bool
     */
    protected $_includeCarComponent = false;

    /**
     * CarComponentRepository constructor.
     */
    public function __construct() {
        $this->_mapper = new CarComponentLevelMapper();
    }

    /**
     * Get all CarComponentLevelEntities
     *
     * @return array of CarComponentLevelEntities
     */
    public function all(): array
    {
        if ($this->_filters) {
            $query = EloquentCarComponentLevelModel::query();
            $this->_applyFilters($query);
            $results = $query->get();
        }
        else {
            $results = EloquentCarComponentLevelModel::all();
        }

        if (!$results) {
            return [];
        }

        $return = [];
        foreach ($results as $carComponentLevelModel) {
            $return[] = $this->_mapToEntity($carComponentLevelModel);
        }
        return $return;
    }

    /**
     * Get the first CarComponentLevelEntity from an all() result
     *
     * @return CarComponentLevelEntity|null
     */
    public function findOne(): ?CarComponentLevelEntity
    {
        $results = $this->all();
        return ($results) ? $results[0] : null;
    }

    /**
     * Find the CarComponentLevel object by Id
     *
     * @param int $id
     * @return CarComponentLevelEntity
     */
    public function findById(int $id): ?CarComponentLevelEntity
    {
        $carComponentLevelModel = EloquentCarComponentLevelModel::find($id);
        if (!$carComponentLevelModel) {
            return null;
        }
        return $this->_mapToEntity($carComponentLevelModel);
    }

    /**
     * Set whether to include the parent CarComponent in the returned entities.
     * Defaults to true.
     *
     * @param bool $include
     * @return self
     */
    public function includeCarComponent($include = true): self
    {
        $this->_includeCarComponent = $include;
        return $this;
    }

    /**
     * Get all CarComponentLevel entities that belong to a CarComponent
     *
     * @param CarComponentEntity $carComponentEntity
     * @return array
     */
    public function findForCarComponent(CarComponentEntity $carComponentEntity)
    {
        $results = EloquentCarComponentLevelModel::where('car_component_id', $carComponentEntity->getCarComponentId())->get();
        if (!$results) {
            return [];
        }

        $return = [];
        foreach ($results as $carComponentLevelModel) {
            $return[] = $this->_mapToEntity($carComponentLevelModel);
        }

        return $return;
    }

    /**
     * Save a new entity
     *
     * @param CarComponentLevelEntity $entity
     * @return bool
     */
    public function create(CarComponentLevelEntity &$entity): bool
    {
        return $this->_create($entity);
    }

    /**
     * Returns an Entity for a given Model
     *
     * @param EloquentCarComponentLevelModel $carComponentLevelModel
     * @return CarComponentLevelEntity
     */
    protected function _mapToEntity(EloquentCarComponentLevelModel $carComponentLevelModel): CarComponentLevelEntity
    {
        /* @var CarComponentLevelEntity $carComponentLevelEntity */
        $carComponentLevelEntity = $this->_mapper->toEntity($carComponentLevelModel);

        return $carComponentLevelEntity;
    }

    /**
     * Add query filter on car_component_id
     *
     * @param array|int $filterValue
     * @return $this
     */
    public function filterByCarComponentId($filterValue): self
    {
        $this->_filters['car_component_id'] = $filterValue;
        return $this;
    }

    /**
     * Add query filter on level
     *
     * @param array|int $filterValue
     * @return $this
     */
    public function filterByLevel($filterValue): self
    {
        $this->_filters['level'] = $filterValue;
        return $this;
    }
}

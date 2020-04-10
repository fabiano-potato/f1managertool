<?php

namespace App\Repositories\Eloquent;

use App\Facades\CarComponent;
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
     * Get all CarComponentLevelEntities
     *
     * @return array of CarComponentLevelEntities
     */
    public function find(): array
    {
        $results = EloquentCarComponentLevelModel::all();
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

        if ($this->_includeCarComponent) {
            $carComponentLevelEntity->setCarComponentEntity(
                CarComponent::findById($carComponentLevelEntity->getCarComponentId())
            );
        }

        return $carComponentLevelEntity;
    }
}

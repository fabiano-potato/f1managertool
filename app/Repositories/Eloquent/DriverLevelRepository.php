<?php

namespace App\Repositories\Eloquent;

use App\Facades\Driver;
use App\Models\Entities\DriverEntity;
use \App\Models\Entities\DriverLevelEntity;
use \App\Contracts\Repositories\DriverLevelRepositoryInterface;
use \App\Models\Eloquent\EloquentDriverLevelModel;
use \App\Models\Mappers\Eloquent\DriverLevelMapper;

/**
 * Class DriverLevelRepository
 * @package App\Repositories\Eloquent
 */
class DriverLevelRepository extends AbstractEloquentRepository implements DriverLevelRepositoryInterface
{
    /**
     * @var DriverLevelMapper|null
     */
    protected $_mapper = null;

    /**
     * Whether to include and return the parent Driver
     *
     * @var bool
     */
    protected $_includeDriver = false;

    /**
     * DriverRepository constructor.
     */
    public function __construct() {
        $this->_mapper = new DriverLevelMapper();
    }

    /**
     * Find the DriverLevel object by Id
     *
     * @param int $id
     * @return DriverLevelEntity
     */
    public function findById(int $id): ?DriverLevelEntity
    {
        $driverLevelModel = EloquentDriverLevelModel::find($id);
        if (!$driverLevelModel) {
            return null;
        }
        return $this->_mapToEntity($driverLevelModel);
    }

    /**
     * Set whether to include the parent Driver in the returned entities.
     * Defaults to true.
     *
     * @param bool $include
     * @return self
     */
    public function includeDriver($include = true): self
    {
        $this->_includeDriver = $include;
        return $this;
    }

    /**
     * Get all DriverLevelEntities
     *
     * @return array of DriverLevelEntities
     */
    public function all(): array
    {
        $results = EloquentDriverLevelModel::all();
        if (!$results) {
            return [];
        }

        $return = [];
        foreach ($results as $driverLevelModel) {
            $return[] = $this->_mapToEntity($driverLevelModel);
        }
        return $return;
    }

    /**
     * Get all DriverLevel entities that belong to a Driver
     *
     * @param DriverEntity $driverEntity
     * @return array
     */
    public function findForDriver(DriverEntity $driverEntity)
    {
        $results = EloquentDriverLevelModel::where('driver_id', $driverEntity->getDriverId())->get();
        if (!$results) {
            return [];
        }

        $return = [];
        foreach ($results as $driverLevelModel) {
            $return[] = $this->_mapToEntity($driverLevelModel);
        }

        return $return;
    }

    /**
     * Save a new entity
     *
     * @param DriverLevelEntity $entity
     * @return bool
     */
    public function create(DriverLevelEntity &$entity): bool
    {
        return $this->_create($entity);
    }

    /**
     * Returns an Entity for a given Model
     *
     * @param EloquentDriverLevelModel $driverLevelModel
     * @return DriverLevelEntity
     */
    protected function _mapToEntity(EloquentDriverLevelModel $driverLevelModel): DriverLevelEntity
    {
        /* @var DriverLevelEntity $driverLevelEntity */
        $driverLevelEntity = $this->_mapper->toEntity($driverLevelModel);

        if ($this->_includeDriver) {
            $driverLevelEntity->setDriverEntity(
                Driver::findById($driverLevelEntity->getDriverId())
            );
        }

        return $driverLevelEntity;
    }
}

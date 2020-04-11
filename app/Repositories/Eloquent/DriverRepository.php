<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\DriverRepositoryInterface;
use App\Facades\DriverLevel;
use App\Models\Eloquent\EloquentDriverModel;
use App\Models\Entities\DriverEntity;
use App\Models\Mappers\Eloquent\DriverMapper;

/**
 * Class DriverRepository
 * @package App\Repositories\Eloquent
 */
class DriverRepository extends AbstractEloquentRepository implements DriverRepositoryInterface
{
    /**
     * @var DriverMapper|null
     */
    protected $_mapper = null;

    /**
     * Whether to include and return the child DriverLevel entities
     *
     * @var bool
     */
    protected $_includeDriverLevels = false;

    /**
     * DriverRepository constructor.
     */
    public function __construct(){
        $this->_mapper = new DriverMapper();
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $entities = [];
        $results = EloquentDriverModel::all();
        foreach ($results as $driverModel)
        {
            $entities[] =$this->_mapToEntity($driverModel);
        }
        return $entities;
    }

    /**
     * Find entity by its Id
     *
     * @param $id
     * @return null|DriverEntity
     */
    public function findById($id): ?DriverEntity
    {
        $model = EloquentDriverModel::find($id);
        if (!$model) {
            return null;
        }
        return $this->_mapToEntity($model);
    }

    /**
     * Save a new entity
     *
     * @param DriverEntity $entity
     * @return bool
     */
    public function create(DriverEntity &$entity): bool
    {
        return $this->_create($entity);
    }

    /**
     * Returns an Entity for a given Model
     *
     * @param EloquentDriverModel $driverModel
     * @return DriverEntity
     */
    protected function _mapToEntity(EloquentDriverModel $driverModel): DriverEntity
    {
        /* @var DriverEntity $driverEntity */
        $driverEntity = $this->_mapper->toEntity($driverModel);
        if ($this->_includeDriverLevels) {
            $driverEntity->setDriverLevels(
                DriverLevel::findForDriver($driverEntity)
            );
        }

        return $driverEntity;
    }

    /**
     * Whether to include and return the child DriverLevel entities
     *
     * @param bool $include
     * @return self
     */
    public function includeDriverLevels($include = true): self
    {
        $this->_includeDriverLevels = $include;
        return $this;
    }
}

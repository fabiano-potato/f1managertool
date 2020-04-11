<?php

namespace App\Repositories\Eloquent;

use \App\Models\Entities\UserCarComponentEntity;
use \App\Contracts\Repositories\UserCarComponentRepositoryInterface;
use \App\Models\Eloquent\EloquentUserCarComponentModel;
use App\Models\Mappers\Eloquent\UserCarComponentMapper;

/**
 * Class UserCarComponentsRepository
 * @package App\Repositories\Eloquent
 */
class UserCarComponentRepository extends AbstractEloquentRepository implements UserCarComponentRepositoryInterface
{
    /**
     * @var UserCarComponentMapper|null
     */
    protected $_mapper = null;

    /**
     * UserCarComponentsRepository constructor.
     */
    public function __construct(){
        $this->_mapper = new UserCarComponentMapper();
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $entities = [];
        $results = EloquentUserCarComponentModel::all();
        foreach ($results as $userCarComponentsModel)
        {
            $entities[] =$this->_mapToEntity($userCarComponentsModel);
        }
        return $entities;
    }

    /**
     * Find entity by its Id
     *
     * @param $id
     * @return null|UserCarComponentEntity
     */
    public function findById($id): ?UserCarComponentEntity
    {
        $model = EloquentUserCarComponentModel::find($id);
        if (!$model) {
            return null;
        }
        return $this->_mapToEntity($model);
    }

    /**
     * Save a new entity
     *
     * @param UserCarComponentEntity $entity
     * @return bool
     */
    public function create(UserCarComponentEntity &$entity): bool
    {
        return $this->_create($entity);
    }

    /**
     * Returns an Entity for a given Model
     *
     * @param EloquentUserCarComponentModel $userCarComponentsModel
     * @return UserCarComponentEntity
     */
    protected function _mapToEntity(EloquentUserCarComponentModel $userCarComponentsModel): UserCarComponentEntity
    {
        /* @var UserCarComponentEntity $userCarComponentEntity */
        $userCarComponentEntity = $this->_mapper->toEntity($userCarComponentsModel);
        return $userCarComponentEntity;
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\CarComponentRepositoryInterface;
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
     * List of filters for this query
     *
     * @var array
     */
    protected $_filters = [];

    /**
     * @var CarComponentRepositoryInterface
     */
    protected $_carComponentRepository;

    /**
     * UserCarComponentsRepository constructor.
     * @param CarComponentRepositoryInterface $carComponentRepository
     */
    public function __construct(CarComponentRepositoryInterface $carComponentRepository){
        $this->_carComponentRepository = $carComponentRepository;
        $this->_mapper = new UserCarComponentMapper();
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $entities = [];

        if ($this->_filters) {
            $query = EloquentUserCarComponentModel::Query();
            $this->_applyFilters($query);
            $results = $query->get();
        }
        else {
            $results = EloquentUserCarComponentModel::all();
        }

        foreach ($results as $userCarComponentsModel)
        {
            $entities[] =$this->_mapToEntity($userCarComponentsModel);
        }
        return $entities;
    }

    /**
     * Get the first entity from an all() result
     *
     * @return UserCarComponentEntity|null
     */
    public function findOne(): ?UserCarComponentEntity
    {
        $results = $this->all();
        return ($results) ? $results[0] : null;
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

    /**
     * Filter query by userId
     *
     * @param mixed $userId
     * @return UserCarComponentRepository
     */
    public function filterUserId($userId): self
    {
        $this->_filters['user_id'] = $userId;
        return $this;
    }

    /**
     * Filter query by car_component_type
     *
     * @param mixed $type
     * @return UserCarComponentRepository
     */
    public function filterCarComponentType($type): self
    {
        $this->_filters['car_component_type'] = $type;
        return $this;
    }

    /**
     * Filter by array or int of ids
     *
     * @param mixed $id
     * @return UserCarComponentRepository
     */
    public function filterCarComponentId($id): self
    {
        $this->_filters['car_component_id'] = $id;
        return $this;
    }

    /**
     * Unassign any preexisting CarComponents for the given type
     *
     * @param $userId
     * @param $type
     * @return UserCarComponentRepository
     */
    public function unassignComponentsForType(int $userId, int $type): self
    {
        EloquentUserCarComponentModel::where(
            ['user_id' => $userId, 'car_component_type' => $type]
        )->update(['is_assigned' => false]);
        return $this;
    }

    /**
     * Update an existing UserCarComponentEntity
     *
     * @param UserCarComponentEntity $entity
     * @return bool
     */
    public function update(UserCarComponentEntity &$entity): bool
    {
        $modelProperties = $this->_mapper->toModel($entity)->toArray();

        // Filter out some properties we don't want updated
        unset($modelProperties['created_at']);
        unset($modelProperties['user_car_components_id']);
        unset($modelProperties['user_id']);

        // Set the updated_at timestamp
        $modelProperties['updated_at'] = date('Y-m-d H:i:s');

        return EloquentUserCarComponentModel::where('user_car_components_id', $entity->getUserCarComponentsId())
            ->update($modelProperties);
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Facades\CarComponent;
use App\Models\Entities\CarComponentLevelEntity;
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

        if ($this->_filters) {
            $query = EloquentUserCarComponentModel::Query();

            $this->_filter($query, 'user_id', $this->_filters['user_id'] ?: null);
            $this->_filter($query, 'car_component_type', $this->_filters['car_component_type'] ?: null);

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
     * @param int $userId
     * @return UserCarComponentRepository
     */
    public function filterUserId(int $userId): self
    {
        $this->_filters['user_id'] = $userId;
        return $this;
    }

    /**
     * Filter query by car_component_type
     *
     * @param int $type
     * @return UserCarComponentRepository
     */
    public function filterCarComponentType(int $type): self
    {
        $this->_filters['car_component_type'] = $type;
        return $this;
    }

    /**
     * Set a CarComponent as assigned for a user.
     * This will unassign any preexisting CarComponents that are assigned to the user for the same type.
     *
     * @param CarComponentLevelEntity $carComponentLevelEntity
     * @param $userId
     * @param bool $isAssigned
     * @return bool
     */
    public function setCarComponentLevelForUser(CarComponentLevelEntity $carComponentLevelEntity, $userId, $isAssigned = false): bool
    {
        // Get CarComponent
        $carComponentEntity = CarComponent::findById($carComponentLevelEntity->getCarComponentId());

        if ($isAssigned) {
            // Unassign any preexisting CarComponents for the given type
            EloquentUserCarComponentModel::where(
                ['user_id' => $userId, 'car_component_type' => $carComponentEntity->getType()]
            )->update(['is_assigned' => false]);
        }
        else {
            die('not assigned');
        }

        // Create or Update UserCarComponent
        $result = EloquentUserCarComponentModel::updateOrCreate(
            ['user_id' => $userId, 'car_component_id' => $carComponentEntity->getCarComponentId()],
            [
                'car_component_type' => $carComponentEntity->getType(),
                'is_assigned' => $isAssigned,
                'current_level' => $carComponentLevelEntity->getLevel(),
            ]
        );

        return (bool) $result;
    }

    /**
     * Get the currently selected (or highest level user enabled) CarComponentLevelEntity for a CarComponent & User
     *
     * @param $userId
     * @param $carComponent
     * @return CarComponentLevelEntity|null
     */
    public function getActiveCarComponentLevelForUser($userId, $carComponent): ?CarComponentLevelEntity
    {
//        CarComponentLevel::
    }
}

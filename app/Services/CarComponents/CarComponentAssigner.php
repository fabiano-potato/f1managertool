<?php

namespace App\Services\CarComponents;

use App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use App\Contracts\Repositories\CarComponentRepositoryInterface;
use App\Contracts\Repositories\UserCarComponentRepositoryInterface;
use App\Models\Entities\UserCarComponentEntity;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CarComponentAssigner
 * @package App\Services\CarComponents
 *
 * This class handles assigning a CarComponent to a User/Car
 */
class CarComponentAssigner
{
    /**
     * @var UserCarComponentRepositoryInterface
     */
    protected $_userCarComponentRepository;

    /**
     * @var CarComponentLevelRepositoryInterface
     */
    protected $_carComponentLevelRepository;

    /**
     * @var CarComponentRepositoryInterface
     */
    protected $_carComponentRepository;

    /**
     * CarComponentAssigner constructor.
     * @param UserCarComponentRepositoryInterface $userCarComponentRepository
     * @param CarComponentRepositoryInterface $carComponentRepository
     * @param CarComponentLevelRepositoryInterface $carComponentLevelRepository
     */
    public function __construct(UserCarComponentRepositoryInterface $userCarComponentRepository,
                                CarComponentRepositoryInterface $carComponentRepository,
                                CarComponentLevelRepositoryInterface $carComponentLevelRepository)
    {
        $this->_userCarComponentRepository = $userCarComponentRepository;
        $this->_carComponentRepository = $carComponentRepository;
        $this->_carComponentLevelRepository = $carComponentLevelRepository;
    }

    /**
     * Assign a CarComponent to a User/Car
     *
     * @param $userId
     * @param $carComponentLevelId
     * @return bool
     */
    public function assign($userId, $carComponentLevelId)
    {
        // Get CarComponentLevelEntity
        if (!$carComponentLevelEntity = $this->_carComponentLevelRepository->findById($carComponentLevelId)) {
            throw new ModelNotFoundException('CarComponentLevelEntity not found for id: ' . $carComponentLevelId);
        }

        // Get the parent CarComponent
        if (!$carComponentEntity = $this->_carComponentRepository->findById($carComponentLevelEntity->getCarComponentId())) {
            throw new ModelNotFoundException('CarComponentEntity not found for id: ' . $carComponentLevelEntity->getCarComponentId());
        }

        // Unassign any existing CarComponentLevelEntities assigned to user for that type.
        $this->_userCarComponentRepository->unassignComponentsForType($userId, $carComponentEntity->getType());

        // Find a UserCarComponent
        $userCarComponentEntity = $this->_findUserCarComponentEntity($userId, $carComponentLevelEntity->getCarComponentId());

        if ($userCarComponentEntity) {
            // Update the entity and assign to user
            $userCarComponentEntity->setIsAssigned(true);
            return $this->_userCarComponentRepository->update($userCarComponentEntity);
        }
        else {
            // Create a new one
            return $this->_createNewAssigned($userId, $carComponentEntity->getCarComponentId(), $carComponentEntity->getType());
        }
    }

    /**
     * Find a UserCarComponentEntity for a given carComponentId
     *
     * @param $userId
     * @param $carComponentId
     * @return UserCarComponentEntity|null
     */
    protected function _findUserCarComponentEntity($userId, $carComponentId): ?UserCarComponentEntity
    {
        return $this->_userCarComponentRepository->filterUserId($userId)
            ->filterCarComponentId($carComponentId)->findOne();
    }

    /**
     * Create a new UserCarComponentEntity and set it as assigned to User.
     *
     * @param $userId
     * @param $carComponentId
     * @param $type
     * @return bool
     */
    protected function _createNewAssigned($userId, $carComponentId, $type): bool
    {
        // TODO: Implement entity factory
        $userCarComponentEntity = new UserCarComponentEntity();
        $userCarComponentEntity->setUserId($userId)
            ->setCarComponentId($carComponentId)
            ->setCurrentLevel(1) // If entity doesn't exist yet, we're saving the first level
            ->setCarComponentType($type)
            ->setIsAssigned(true)
            ->setCurrentUpgradePoints(0);
        return $this->_userCarComponentRepository->create($userCarComponentEntity);
    }
}

<?php

namespace App\Services\CarComponents;

use App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use App\Contracts\Repositories\CarComponentRepositoryInterface;
use App\Contracts\Repositories\UserCarComponentRepositoryInterface;
use App\Models\Entities\UserCarComponentEntity;
use App\Repositories\Eloquent\UserCarComponentRepository;
use App\User;

/**
 * Class CarComponentUpgrader
 * @package App\Services\CarComponents
 *
 * This class handles upgrading a CarComponent for a User.
 */
class CarComponentUpgrader
{
    /**
     * @var User
     */
    protected $_user;

    /**
     * @var CarComponentLevelRepositoryInterface
     */
    protected $_carComponentLevelRepository;

    /**
     * @var UserCarComponentRepositoryInterface
     */
    protected $_userCarComponentRepository;

    /**
     * @var CarComponentLevelRepositoryInterface
     */
    protected $_carComponentRepository;

    /**
     * CarComponentUpgrader constructor.
     * @param User $user
     * @param CarComponentRepositoryInterface $carComponentRepository
     * @param CarComponentLevelRepositoryInterface $carComponentLevelRepository
     * @param UserCarComponentRepository $userCarComponentRepository
     */
    public function __construct(User $user,
                                CarComponentRepositoryInterface $carComponentRepository,
                                CarComponentLevelRepositoryInterface $carComponentLevelRepository,
                                UserCarComponentRepository $userCarComponentRepository)
    {
        $this->_user = $user;
        $this->_carComponentRepository = $carComponentRepository;
        $this->_carComponentLevelRepository = $carComponentLevelRepository;
        $this->_userCarComponentRepository = $userCarComponentRepository;
    }

    /**
     * Upgrade a CarComponent for a User
     *
     * @param $carComponentId
     * @param $currentLevel
     * @param $userId
     */
    public function upgrade($carComponentId, $currentLevel, $userId)
    {
        // Set the level to be upgraded to
        $upgradeLevel = $currentLevel + 1;

        // Check the new level to upgrade exists
        $carComponentLevelEntity = $this->_carComponentLevelRepository->filterByLevel($upgradeLevel)
            ->filterByCarComponentId($carComponentId)->findOne();

        if (!$carComponentLevelEntity) {
            // Next component to upgrade to is not found
            throw new \RuntimeException('Car component cannot be further upgraded.');
        }

        // Get the current UserCarComponentEntity
        $userCarComponentEntity = $this->_userCarComponentRepository->filterUserId($userId)
            ->filterCarComponentId($carComponentLevelEntity->getCarComponentId())->findOne();

        if ($userCarComponentEntity) {
            // Update the CarComponentLevel assigned to the user
            $userCarComponentEntity->setCurrentLevel($upgradeLevel);

            if (!$this->_userCarComponentRepository->update($userCarComponentEntity)) {
                throw new \RuntimeException('Failed updating UserCarComponentEntity.');
            }
        }
        else {
            // User doesn't have a CarComponent saved for this type, create one
            $userCarComponentEntity = new UserCarComponentEntity();

            // Get the CarComponentEntity, we need the type
            if (!$carComponentEntity = $this->_carComponentRepository
                ->findById($carComponentLevelEntity->getCarComponentId())) {
                throw new \RuntimeException('Could not find CarComponentEntity for id: ' . $carComponentLevelEntity->getCarComponentLevelId());
            }

            // Update the UserCarComponentEntity properties
            $userCarComponentEntity->setCarComponentType($carComponentEntity->getType())
                ->setCarComponentId($carComponentEntity->getCarComponentId())
                ->setCurrentLevel($upgradeLevel)
                ->setUserId($userId);

            if (!$this->_userCarComponentRepository->create($userCarComponentEntity)) {
                throw new \RuntimeException('Failed saving new UserCarComponentEntity.');
            }
        }
    }
}

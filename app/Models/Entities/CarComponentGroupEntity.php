<?php

namespace App\Models\Entities;

use App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use App\Contracts\Repositories\CarComponentRepositoryInterface;
use App\Contracts\Repositories\UserCarComponentRepositoryInterface;
use App\Services\Comparers\CarComponentLevelComparer;

class CarComponentGroupEntity extends AbstractEntity
{
    /**
     * The type of car component for this group
     *
     * @var int
     */
    protected $_carComponentType;

    /**
     * The name of this group
     *
     * @var string
     */
    protected $_name;

    /**
     * The current userId
     *
     * @var int
     */
    protected $_userId;

    /**
     * Array of CarComponents belonging to this Group
     *
     * @var array
     */
    protected $_carComponents;

    /**
     * The CarComponentLevelEntity that is currently assigned to the user for this group.
     * Used for comparison for the other CarComponents/Levels
     *
     * @var ?CarComponentLevelEntity
     */
    protected $_assignedCarComponentLevel;

    /**
     * @var CarComponentRepositoryInterface
     */
    protected $_carComponentRepository;

    /**
     * @var CarComponentLevelRepositoryInterface
     */
    protected $_carComponentLevelRepository;

    /**
     * @var UserCarComponentRepositoryInterface
     */
    protected $_userCarComponentRepository;

    /**
     * CarComponentGroupEntity constructor.
     * @param CarComponentRepositoryInterface $carComponentRepository
     * @param CarComponentLevelRepositoryInterface $carComponentLevelRepository
     * @param UserCarComponentRepositoryInterface $userCarComponentRepository
     * @param int $carComponentType
     * @param int|null $userId
     */
    public function __construct(CarComponentRepositoryInterface $carComponentRepository,
                                CarComponentLevelRepositoryInterface $carComponentLevelRepository,
                                UserCarComponentRepositoryInterface $userCarComponentRepository,
                                int $carComponentType,
                                int $userId = null)
    {
        $this->_carComponentRepository = $carComponentRepository;
        $this->_carComponentLevelRepository = $carComponentLevelRepository;
        $this->_userCarComponentRepository = $userCarComponentRepository;
        $this->_userId = $userId;
        $this->_carComponentType = $carComponentType;
        $this->_setName($carComponentType)
            ->_fillCarComponents()
            ->_sortCarComponents()
            ->_compareCarComponentLevels();
    }

    /**
     * Set the name for this group
     *
     * @param $type
     * @return CarComponentGroupEntity
     */
    protected function _setName($type): self
    {
        // Set the name from the CarComponent's type
        $this->_name = CarComponentEntity::$types[$type];
        return $this;
    }

    /**
     * Fill the group with CarComponents and the active CarComponentLevels
     * @return CarComponentGroupEntity
     */
    protected function _fillCarComponents(): self
    {
        // Track the CarComponentEntities we get from the user so we don't have to query for them again
        $userCarComponentIds = [];

        if ($this->_userId) {
            // Get the UserCarComponents already saved to the User
            $userCarComponents = $this->_userCarComponentRepository->filterUserId($this->_userId)
                ->filterCarComponentType($this->_carComponentType)->all();

            /* @var UserCarComponentEntity $userCarComponentEntity */
            foreach ($userCarComponents as $userCarComponentEntity) {
                /* @var CarComponentEntity $carComponentEntity */
                $carComponentEntity = $this->_carComponentRepository->findById($userCarComponentEntity->getCarComponentId());
                $carComponentLevelEntity = $this->_carComponentLevelRepository->filterByCarComponentId($carComponentEntity->getCarComponentId())
                    ->filterByLevel($userCarComponentEntity->getCurrentLevel())
                    ->findOne();
                if (!$carComponentLevelEntity) {
                    throw new \RuntimeException('CarComponentLevelEntity not found.');
                }
                $carComponentEntity->setActiveCarComponentLevel($carComponentLevelEntity);
                $userCarComponentIds[] = $userCarComponentEntity->getCarComponentId();

                // Set this CarComponentLevelEntity as the assigned entity for the group
                if ($userCarComponentEntity->isAssigned()) {
                    $carComponentEntity->setIsAssigned(true);
                    $this->_assignedCarComponentLevel = $carComponentLevelEntity;
                }

                $this->_carComponents[] = $carComponentEntity;
            }
        }

        // Get all the CarComponent Entities for the Group
        $carComponentEntities = $this->_carComponentRepository->filterType($this->_carComponentType)
            ->filterNotCarComponentIds($userCarComponentIds)->all();

        foreach ($carComponentEntities as $carComponentEntity) {
            $carComponentEntity->setActiveCarComponentLevel(
                $this->_carComponentLevelRepository->filterByCarComponentId($carComponentEntity->getCarComponentId())
                    ->filterByLevel(1)
                    ->all()[0]
            );
            $this->_carComponents[] = $carComponentEntity;
        }
        return $this;
    }

    /**
     * Compare the CarComponentLevels for this group
     *
     * @return $this
     */
    protected function _compareCarComponentLevels(): self
    {
        if (!$this->_assignedCarComponentLevel) {
            return $this;
        }

        /* @var CarComponentEntity $carComponent */
        foreach ($this->_carComponents as $carComponent)
        {
            if ($carComponent->getActiveCarComponentLevel()->getCarComponentLevelId()
                != $this->_assignedCarComponentLevel->getCarComponentLevelId())
            {
                // Add comparer
                $comparer = new CarComponentLevelComparer($this->_assignedCarComponentLevel, $carComponent->getActiveCarComponentLevel());
                $comparer->compare();
                $carComponent->getActiveCarComponentLevel()->setComparer($comparer);
            }
        }

        return $this;
    }

    /**
     * Sort the CarComponent entities
     *
     * @return CarComponentGroupEntity
     */
    protected function _sortCarComponents(): self
    {
        usort($this->_carComponents, [CarComponentGroupEntity::class, '_sortCallback']);
        return $this;
    }

    /**
     * Callback for sorting CarComponentEntities by their active CarComponentLevel upgrade cost
     *
     * @param CarComponentEntity $a
     * @param CarComponentEntity $b
     * @return int
     */
    protected static function _sortCallback(CarComponentEntity $a, CarComponentEntity $b)
    {
        if ($a->getActiveCarComponentLevel()->getUpgradeCost() == $b->getActiveCarComponentLevel()->getUpgradeCost()) {
            return 0;
        }
        return ($a->getActiveCarComponentLevel()->getUpgradeCost() > $b->getActiveCarComponentLevel()->getUpgradeCost())
            ? 1
            : -1;
    }

    /**
     * @return int
     */
    public function getCarComponentType(): int
    {
        return $this->_carComponentType;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @return array
     */
    public function getCarComponents(): array
    {
        return $this->_carComponents;
    }

    /**
     * @return null|CarComponentLevelEntity
     */
    public function getAssignedCarComponentLevel(): ?CarComponentLevelEntity
    {
        return $this->_assignedCarComponentLevel;
    }
}

<?php

namespace App\Models\Entities;

/**
 * Class UserCarComponentEntity
 * @package App\Models\Entities
 *
 * This class handles the association between a User and CarComponent entities
 */
class UserCarComponentEntity extends AbstractEntity
{
    /**
     * The primary key for entity
     *
     * @var int $_userCarComponentsId
     */
    protected $_userCarComponentsId;

    /**
     * The foreign key to the User entity
     *
     * @var int $_userId
     */
    protected $_userId;

    /**
     * The foreign key to the CarComponent entity
     *
     * @var
     */
    protected $_carComponentId;

    /**
     * The number of current upgrade points that User has for this component
     *
     * @var int
     */
    protected $_currentUpgradePoints;

    /**
     * The current unlocked level for this component
     *
     * @var int
     */
    protected $_currentLevel;

    /**
     * Whether this component is assigned to the user's car
     *
     * @var boolean
     */
    protected $_assignedToCar;

    /**
     * The timestamp that the entity was created
     *
     * @var string
     */
    protected $_createdAt;

    /**
     * The timestamp that the entity was last updated
     *
     * @var string
     */
    protected $_updatedAt;

    /**
     * @return mixed
     */
    public function getUserCarComponentsId()
    {
        return $this->_userCarComponentsId;
    }

    /**
     * @param mixed $userCarComponentsId
     */
    public function setUserCarComponentsId($userCarComponentsId): void
    {
        $this->_userCarComponentsId = $userCarComponentsId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->_userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCarComponentId()
    {
        return $this->_carComponentId;
    }

    /**
     * @param mixed $carComponentId
     */
    public function setCarComponentId($carComponentId): void
    {
        $this->_carComponentId = $carComponentId;
    }

    /**
     * @return mixed
     */
    public function getCurrentUpgradePoints()
    {
        return $this->_currentUpgradePoints;
    }

    /**
     * @param mixed $currentUpgradePoints
     */
    public function setCurrentUpgradePoints($currentUpgradePoints): void
    {
        $this->_currentUpgradePoints = $currentUpgradePoints;
    }

    /**
     * @return mixed
     */
    public function getCurrentLevel()
    {
        return $this->_currentLevel;
    }

    /**
     * @param mixed $currentLevel
     */
    public function setCurrentLevel($currentLevel): void
    {
        $this->_currentLevel = $currentLevel;
    }

    /**
     * @return bool
     */
    public function isAssignedToCar(): bool
    {
        return $this->_assignedToCar;
    }

    /**
     * @param bool $assignedToCar
     */
    public function setAssignedToCar(bool $assignedToCar): void
    {
        $this->_assignedToCar = $assignedToCar;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_createdAt;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->_createdAt = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->_updatedAt;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->_updatedAt = $updated_at;
    }
}

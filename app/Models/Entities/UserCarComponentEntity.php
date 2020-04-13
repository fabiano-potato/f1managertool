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
     * The type of car component
     *
     * @var int
     */
    protected $_carComponentType;

    /**
     * The foreign key to the CarComponent entity
     *
     * @var int
     */
    protected $_carComponentId;

    /**
     * The number of current upgrade points that User has for this component
     *
     * @var int
     */
    protected $_currentUpgradePoints = 0;

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
    protected $_isAssigned = false;

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
     * The current CarComponentLevelEntity
     *
     * @var CarComponentLevelEntity
     */
    protected $_carComponentLevel;

    /**
     * @return mixed
     */
    public function getUserCarComponentsId()
    {
        return $this->_userCarComponentsId;
    }

    /**
     * @param mixed $userCarComponentsId
     * @return UserCarComponentEntity
     */
    public function setUserCarComponentsId($userCarComponentsId): self
    {
        $this->_userCarComponentsId = $userCarComponentsId;
        return $this;
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
     * @return UserCarComponentEntity
     */
    public function setUserId($userId): self
    {
        $this->_userId = $userId;
        return $this;
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
     * @return UserCarComponentEntity
     */
    public function setCarComponentId($carComponentId): self
    {
        $this->_carComponentId = $carComponentId;
        return $this;
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
     * @return UserCarComponentEntity
     */
    public function setCurrentUpgradePoints($currentUpgradePoints): self
    {
        $this->_currentUpgradePoints = $currentUpgradePoints;
        return $this;
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
     * @return UserCarComponentEntity
     */
    public function setCurrentLevel($currentLevel): self
    {
        $this->_currentLevel = $currentLevel;
        return $this;
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
     * @return UserCarComponentEntity
     */
    public function setCreatedAt($created_at): self
    {
        $this->_createdAt = $created_at;
        return $this;
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
     * @return UserCarComponentEntity
     */
    public function setUpdatedAt($updated_at): self
    {
        $this->_updatedAt = $updated_at;
        return $this;
    }

    /**
     * @return int
     */
    public function getCarComponentType(): int
    {
        return $this->_carComponentType;
    }

    /**
     * @param int $carComponentType
     * @return UserCarComponentEntity
     */
    public function setCarComponentType(int $carComponentType): self
    {
        $this->_carComponentType = $carComponentType;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAssigned(): bool
    {
        return $this->_isAssigned;
    }

    /**
     * @param bool $isAssigned
     * @return self
     */
    public function setIsAssigned(bool $isAssigned): self
    {
        $this->_isAssigned = $isAssigned;
        return $this;
    }

    /**
     * @return CarComponentLevelEntity
     */
    public function getCarComponentLevel(): ?CarComponentLevelEntity
    {
        return $this->_carComponentLevel;
    }

    /**
     * @param CarComponentLevelEntity $carComponentLevel
     * @return self
     */
    public function setCarComponentLevel(CarComponentLevelEntity $carComponentLevel): self
    {
        $this->_carComponentLevel = $carComponentLevel;
        return $this;
    }
}

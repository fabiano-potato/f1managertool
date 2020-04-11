<?php

namespace App\Models\Entities;

class UserCarComponentEntity extends AbstractEntity
{
    protected $_userCarComponentsId;
    protected $_userId;
    protected $_carComponentId;
    protected $_currentUpgradePoints;
    protected $_currentLevel;
    protected $_created_at;
    protected $_updated_at;

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
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->_created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->_updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->_updated_at = $updated_at;
    }
}

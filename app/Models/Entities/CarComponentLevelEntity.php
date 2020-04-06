<?php

namespace App\Models\Entities;

/**
 * Class CarComponentLevelEntity
 * @package App\Models\Entities
 */
class CarComponentLevelEntity extends AbstractEntity
{
    /**
     * @var int the id for this entity
     */
    protected $_carComponentLevelId = null;
    /**
     * @var int the id for parent CarComponent entity
     */
    protected $_carComponentId = null;

    /**
     * @var int the level of this instance.
     */
    protected $_level = null;

    /**
     * @var float the upgrade cost to purchase this component level
     */
    protected $_upgradeCost = null;

    /**
     * @var int the power property value for this component level
     */
    protected $_statPower = null;

    /**
     * @var int the aero property value for this component level
     */
    protected $_statAero = null;

    /**
     * @var int the grip property value for this component level
     */
    protected $_statGrip = null;

    /**
     * @var int the reliability property value for this component level
     */
    protected $_statReliability = null;

    /**
     * @var float the pit stop time property value for this component level
     */
    protected $_statPitStop = null;

    /**
     * @var int the number of upgrade points required to enable this component level for purchase
     */
    protected $_requiredUpgradePoints = null;

    /**
     * @var string the timestamp for when this instance was saved
     */
    protected $_createdAt = null;

    /**
     * @var string the timestamp for when this instance was last saved
     */
    protected $_updatedAt = null;

    /**
     * @return int
     */
    public function getCarComponentLevelId()
    {
        return $this->_carComponentLevelId;
    }

    /**
     * @param int $carComponentLevelId
     * @return CarComponentLevelEntity
     */
    public function setCarComponentLevelId(int $carComponentLevelId)
    {
        $this->_carComponentLevelId = $carComponentLevelId;
        return $this;
    }

    /**
     * @return int
     */
    public function getCarComponentId()
    {
        return $this->_carComponentId;
    }

    /**
     * @param int $carComponentId
     * @return CarComponentLevelEntity
     */
    public function setCarComponentId(int $carComponentId)
    {
        $this->_carComponentId = $carComponentId;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): ?int
    {
        return $this->_level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level)
    {
        $this->_level = $level;
    }

    /**
     * @return float
     */
    public function getUpgradeCost(): ?float
    {
        return $this->_upgradeCost;
    }

    /**
     * @param float $upgradeCost
     */
    public function setUpgradeCost(float $upgradeCost)
    {
        $this->_upgradeCost = $upgradeCost;
    }

    /**
     * @return int
     */
    public function getStatPower(): ?int
    {
        return $this->_statPower;
    }

    /**
     * @param int $statPower
     */
    public function setStatPower(int $statPower)
    {
        $this->_statPower = $statPower;
    }

    /**
     * @return int
     */
    public function getStatAero(): ?int
    {
        return $this->_statAero;
    }

    /**
     * @param int $statAero
     */
    public function setStatAero(int $statAero)
    {
        $this->_statAero = $statAero;
    }

    /**
     * @return int
     */
    public function getStatGrip(): ?int
    {
        return $this->_statGrip;
    }

    /**
     * @param int $statGrip
     * @return CarComponentLevelEntity
     */
    public function setStatGrip(int $statGrip)
    {
        $this->_statGrip = $statGrip;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatReliability(): ?int
    {
        return $this->_statReliability;
    }

    /**
     * @param int $statReliability
     * @return CarComponentLevelEntity
     */
    public function setStatReliability(int $statReliability)
    {
        $this->_statReliability = $statReliability;
        return $this;
    }

    /**
     * @return float
     */
    public function getStatPitStop(): ?float
    {
        return $this->_statPitStop;
    }

    /**
     * @param float $statPitStop
     * @return CarComponentLevelEntity
     */
    public function setStatPitStop(float $statPitStop)
    {
        $this->_statPitStop = $statPitStop;
        return $this;
    }

    /**
     * @return int
     */
    public function getRequiredUpgradePoints(): ?int
    {
        return $this->_requiredUpgradePoints;
    }

    /**
     * @param int $requiredUpgradePoints
     * @return CarComponentLevelEntity
     */
    public function setRequiredUpgradePoints(int $requiredUpgradePoints)
    {
        $this->_requiredUpgradePoints = $requiredUpgradePoints;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): ?string
    {
        return $this->_createdAt;
    }

    /**
     * @param string $createdAt
     * @return CarComponentLevelEntity
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->_createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->_updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return CarComponentLevelEntity
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->_updatedAt = $updatedAt;
        return $this;
    }
}

<?php

namespace App\Models\Entities;

/**
 * Class DriverLevelEntity
 * @package App\Models\Entities
 */
class DriverLevelEntity extends AbstractEntity
{
    /**
     * Primary key for this entity.
     *
     * @var int
     */
    protected $_driverLevelId;

    /**
     * Foreign key to the parent Driver entity.
     *
     * @var int
     */
    protected $_driverId;

    /**
     * The current level of this driver level entity.
     *
     * @var int
     */
    protected $_level;

    /**
     * @var int
     */
    protected $_statOvertaking;

    /**
     * @var int
     */
    protected $_statDefending;

    /**
     * @var int
     */
    protected $_statConsistency;

    /**
     * @var int
     */
    protected $_statFuelManagement;

    /**
     * @var int
     */
    protected $_statTyreManagement;

    /**
     * @var int
     */
    protected $_statWetWeather;

    /**
     * @var int
     */
    protected $_upgradePoints;

    /**
     * The required cost to upgrade to the next level for this driver
     *
     * @var float
     */
    protected $_upgradeCost;

    /**
     * @var string
     */
    protected $_created_at;

    /**
     * @var string
     */
    protected $_updated_at;

    /**
     * @var null|DriverEntity
     */
    protected $_driver;

    /**
     * @return int
     */
    public function getDriverLevelId(): ?int
    {
        return $this->_driverLevelId;
    }

    /**
     * @param int $driverLevelId
     * @return self
     */
    public function setDriverLevelId(int $driverLevelId): self
    {
        $this->_driverLevelId = $driverLevelId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDriverId(): ?int
    {
        return $this->_driverId;
    }

    /**
     * @param int $driverId
     * @return self
     */
    public function setDriverId(int $driverId): self
    {
        $this->_driverId = $driverId;
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
     * @return self
     */
    public function setLevel(int $level): self
    {
        $this->_level = $level;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatOvertaking(): ?int
    {
        return $this->_statOvertaking;
    }

    /**
     * @param int $statOvertaking
     * @return self
     */
    public function setStatOvertaking(int $statOvertaking): self
    {
        $this->_statOvertaking = $statOvertaking;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatDefending(): ?int
    {
        return $this->_statDefending;
    }

    /**
     * @param int $statDefending
     * @return self
     */
    public function setStatDefending(int $statDefending): self
    {
        $this->_statDefending = $statDefending;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatConsistency(): ?int
    {
        return $this->_statConsistency;
    }

    /**
     * @param int $statConsistency
     * @return self
     */
    public function setStatConsistency(int $statConsistency): self
    {
        $this->_statConsistency = $statConsistency;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatFuelManagement(): ?int
    {
        return $this->_statFuelManagement;
    }

    /**
     * @param int $statFuelManagement
     * @return self
     */
    public function setStatFuelManagement(int $statFuelManagement): self
    {
        $this->_statFuelManagement = $statFuelManagement;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatTyreManagement(): ?int
    {
        return $this->_statTyreManagement;
    }

    /**
     * @param int $statTyreManagement
     * @return self
     */
    public function setStatTyreManagement(int $statTyreManagement): self
    {
        $this->_statTyreManagement = $statTyreManagement;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatWetWeather(): ?int
    {
        return $this->_statWetWeather;
    }

    /**
     * @param int $statWetWeather
     * @return self
     */
    public function setStatWetWeather(int $statWetWeather): self
    {
        $this->_statWetWeather = $statWetWeather;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpgradePoints(): ?int
    {
        return $this->_upgradePoints;
    }

    /**
     * @param int $upgradePoints
     * @return self
     */
    public function setUpgradePoints(int $upgradePoints): self
    {
        $this->_upgradePoints = $upgradePoints;
        return $this;
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
     * @return self
     */
    public function setUpgradeCost(float $upgradeCost): self
    {
        $this->_upgradeCost = $upgradeCost;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): ?string
    {
        return $this->_created_at;
    }

    /**
     * @param string $created_at
     * @return self
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->_created_at = $created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->_updated_at;
    }

    /**
     * @param string $updated_at
     * @return self
     */
    public function setUpdatedAt(string $updated_at): self
    {
        $this->_updated_at = $updated_at;
        return $this;
    }

    /**
     * @return DriverEntity|null
     */
    public function getDriver(): ?DriverEntity
    {
        return $this->_driver;
    }

    /**
     * @param DriverEntity|null $driver
     * @return self
     */
    public function setDriver(?DriverEntity $driver): self
    {
        $this->_driver = $driver;
        return $this;
    }
}

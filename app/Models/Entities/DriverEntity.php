<?php

namespace App\Models\Entities;

/**
 * Class DriverEntity
 * @package App\Models\Entities
 */
class DriverEntity extends AbstractEntity
{
    /**
     * The pk/id of the driver
     *
     * @var null|int
     */
    protected $_driverId = null;

    /**
     * The driver's name
     *
     * @var string
     */
    protected $_name = '';

    /**
     * @var string
     */
    protected $_created_at;

    /**
     * @var string
     */
    protected $_updated_at;

    /**
     * The child driver level objects
     *
     * @var array
     */
    protected $_driverLevels = [];

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
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->_name = $name;
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
     * Get the child DriverLevels for this entity
     *
     * @return array
     */
    public function getDriverLevels(): array
    {
        return $this->_driverLevels;
    }

    /**
     * Set the DriverLevels for this entity
     *
     * @param array $driverLevels
     * @return self
     */
    public function setDriverLevels(array $driverLevels): self
    {
        $this->_driverLevels = $driverLevels;
        return $this;
    }
}

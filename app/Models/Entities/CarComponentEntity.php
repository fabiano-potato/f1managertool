<?php

namespace App\Models\Entities;

/**
 * Class CarComponentEntity
 * @package App\Models\Entities
 */
class CarComponentEntity extends AbstractEntity
{
    const TYPE_BRAKES = 1;
    const TYPE_GEARBOX = 2;
    const TYPE_REAR_WING = 3;
    const TYPE_FRONT_WING = 4;
    const TYPE_SUSPENSION = 5;
    const TYPE_ENGINE = 6;

    public static $types = [
        self::TYPE_BRAKES => 'Brakes',
        self::TYPE_GEARBOX => 'Gearbox',
        self::TYPE_REAR_WING => 'Rear Wing',
        self::TYPE_FRONT_WING => 'Front Wing',
        self::TYPE_SUSPENSION => 'Suspension',
        self::TYPE_ENGINE => 'Engine',
    ];

    /**
     * The child CarComponentLevel entities
     *
     * @var array
     */
    protected $_carComponentLevels = [];

    /**
     * The active CarComponentLevel for this entity
     *
     * @var CarComponentLevelEntity
     */
    protected $_activeCarComponentLevel = null;

    /**
     * @var int the id for this entity
     */
    protected $_carComponentId = null;

    /**
     * @var int the type of component
     */
    protected $_type = null;

    /**
     * @var string the name of this entity
     */
    protected $_name = null;

    /**
     * @var string the timestamp for when this instance was saved
     */
    protected $_createdAt = null;

    /**
     * @var string the timestamp for when this instance was last saved
     */
    protected $_updatedAt = null;

    /**
     * Flag for whether this CarComponent is assigned to the current user
     *
     * @var bool
     */
    protected $_isAssigned = false;

    /**
     * @return int
     */
    public function getCarComponentId(): ?int
    {
        return $this->_carComponentId;
    }

    /**
     * @param int $carComponentId
     * @return CarComponentEntity
     */
    public function setCarComponentId(int $carComponentId)
    {
        $this->_carComponentId = $carComponentId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->_name;
    }

    /**
     * @param string $name
     * @return CarComponentEntity
     */
    public function setName(string $name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->_type;
    }

    /**
     * @param int $type
     * @return CarComponentEntity
     */
    public function setType(int $type)
    {
        $this->_type = $type;
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
     * @return CarComponentEntity
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
     * @return CarComponentEntity
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->_updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Set the child CarComponentLevel entities
     *
     * @param array $carComponentLevelEntities
     * @return $this
     */
    public function setCarComponentLevels(array $carComponentLevelEntities): self
    {
        $this->_carComponentLevels = $carComponentLevelEntities;
        return $this;
    }

    /**
     * Get the child CarComponentLevel entities
     *
     * @return array
     */
    public function getCarComponentLevels(): array
    {
        return $this->_carComponentLevels;
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
     */
    public function setIsAssigned(bool $isAssigned): void
    {
        $this->_isAssigned = $isAssigned;
    }

    /**
     * @return CarComponentLevelEntity
     */
    public function getActiveCarComponentLevel(): CarComponentLevelEntity
    {
        return $this->_activeCarComponentLevel;
    }

    /**
     * @param CarComponentLevelEntity $activeCarComponentLevel
     */
    public function setActiveCarComponentLevel(CarComponentLevelEntity $activeCarComponentLevel): void
    {
        $this->_activeCarComponentLevel = $activeCarComponentLevel;
    }
}

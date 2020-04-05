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
     * @return int
     */
    public function getCarComponentId()
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
    public function getName()
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
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type)
    {
        $this->_type = $type;
    }
}
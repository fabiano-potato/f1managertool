<?php

namespace App\Services\Comparers;

use App\Models\Entities\CarComponentLevelEntity;

/**
 * Class CarComponentLevelComparer
 * @package App\Services
 */
class CarComponentLevelComparer extends AbstractComparer
{
    /**
     * The initial entity to compare against
     *
     * @var CarComponentLevelEntity
     */
    protected $_entityA = null;

    /**
     * The additional entity for comparison
     *
     * @var CarComponentLevelEntity
     */
    protected $_entityB = null;

    /**
     * The difference between the two components for the statPower property
     *
     * @var int
     */
    protected $_diffStatPower = 0;

    /**
     * The difference between the two components for the statAero property
     *
     * @var int
     */
    protected $_diffStatAero = 0;

    /**
     * The difference between the two components for the statGrip property
     *
     * @var int
     */
    protected $_diffStatGrip = 0;

    /**
     * The difference between the two components for the statReliability property
     *
     * @var int
     */
    protected $_diffStatReliability = 0;

    /**
     * The difference between the two components for the statPitStop property
     *
     * @var int
     */
    protected $_diffStatPitStop = 0;

    /**
     * Perform the comparison and update the diff* instance properties
     */
    public function compare()
    {
        $this->_diffStatAero = $this->_entityB->getStatAero() - $this->_entityA->getStatAero();
        $this->_diffStatGrip = $this->_entityB->getStatGrip() - $this->_entityA->getStatGrip();
        $this->_diffStatPitStop = $this->_entityB->getStatPitStop() - $this->_entityA->getStatPitStop();
        $this->_diffStatPower = $this->_entityB->getStatPower() - $this->_entityA->getStatPower();
        $this->_diffStatReliability = $this->_entityB->getStatReliability() - $this->_entityA->getStatReliability();
        return $this;
    }

    /**
     * @return int
     */
    public function getDiffStatPower(): int
    {
        return $this->_diffStatPower;
    }

    /**
     * @return int
     */
    public function getDiffStatAero(): int
    {
        return $this->_diffStatAero;
    }

    /**
     * @return int
     */
    public function getDiffStatGrip(): int
    {
        return $this->_diffStatGrip;
    }

    /**
     * @return int
     */
    public function getDiffStatReliability(): int
    {
        return $this->_diffStatReliability;
    }

    /**
     * @return float
     */
    public function getDiffStatPitStop(): float
    {
        return $this->_diffStatPitStop;
    }
}

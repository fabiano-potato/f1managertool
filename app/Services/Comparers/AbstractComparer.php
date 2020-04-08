<?php

namespace App\Services\Comparers;

use App\Models\Entities\AbstractEntity;

abstract class AbstractComparer
{
    /**
     * The initial entity to compare against
     *
     * @var AbstractEntity
     */
    protected $_entityA = null;

    /**
     * The additional entity for comparison
     *
     * @var AbstractEntity
     */
    protected $_entityB = null;

    /**
     * AbstractComparer constructor.
     * @param AbstractEntity $entityA
     * @param AbstractEntity $entityB
     */
    public function __construct(AbstractEntity $entityA, AbstractEntity $entityB)
    {
        $this->_entityA = $entityA;
        $this->_entityB = $entityB;
    }

    /**
     * Set the initial Entity for comparison
     *
     * @param AbstractEntity $entity
     * @return self
     */
    public function setEntityA(AbstractEntity $entity): self
    {
        $this->_entityA = $entity;
        return $this;
    }

    /**
     * Set the additional Entity for comparison
     *
     * @param AbstractEntity $entity
     * @return self
     */
    public function setEntityB(AbstractEntity $entity): self
    {
        $this->_entityB = $entity;
        return $this;
    }

    /**
     * Perform the comparison and update instance state.
     */
    abstract public function compare();

    /**
     * @return AbstractEntity
     */
    public function getEntityA(): AbstractEntity
    {
        return $this->_entityA;
    }

    /**
     * @return AbstractEntity
     */
    public function getEntityB(): AbstractEntity
    {
        return $this->_entityB;
    }
}

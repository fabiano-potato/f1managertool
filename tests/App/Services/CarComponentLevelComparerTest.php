<?php

namespace Tests\App\Services;

require '../../vendor/autoload.php';

use App\Models\Entities\CarComponentLevelEntity;
use App\Services\CarComponentLevelComparer;
use PHPUnit\Framework\TestCase;


class CarComponentLevelComparerTest extends TestCase
{
    protected $_entityA = null;
    protected $_entityB = null;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->_entityA = new CarComponentLevelEntity();
        $this->_entityA->setLevel(2);
        $this->_entityB = new CarComponentLevelEntity();
        $this->_entityA->setLevel(5);
    }

    /**
     * @inheritDoc
     */
    public function tearDown(): void
    {
        parent::tearDown();

        unset($this->_entityA);
        unset($this->_entityB);
    }

    /**
     * @small
     * @author fsnaith
     * @group carComponentLevel
     */
    public function testSetCarComponentLevel1()
    {
        // SCENARIO: A valid parameter is passed to method.
        // EXPECT: Parameter is set to instance property, _compare() method is called.

        // ARRANGE

        $entityC = new CarComponentLevelEntity();
        $entityC->setStatAero(20);

        $mockCarComponentLevelComparer = $this->getMockBuilder(CarComponentLevelComparer::class)
            ->setMethodsExcept(['setCarComponentLevel1'])
            ->setConstructorArgs([$this->_entityA, $this->_entityB])
            ->getMock();
        // ASSERT method is called
        $mockCarComponentLevelComparer->expects($this->once())->method('_compare');

        // ACT

        $mockCarComponentLevelComparer->setCarComponentLevel1($entityC);

    }
}

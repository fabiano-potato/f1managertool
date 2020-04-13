<?php

namespace Tests\App\Services\Comparers;

use App\Models\Entities\AbstractEntity;
use App\Services\Comparers\AbstractComparer;
use Tests\TestCase;

class AbstractComparerTest extends TestCase
{
    protected $_entityA;
    protected $_entityB;

    public function setUp(): void
    {
        parent::setUp();

        $this->_entityA = $this->getMockBuilder(AbstractEntity::class)
            ->getMock();
        $this->_entityA->name = 'testEntityA';

        $this->_entityB = $this->getMockBuilder(AbstractEntity::class)
            ->getMock();
        $this->_entityB->name = 'testEntityB';
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->_entityA, $this->_entityB);
    }

    /**
     * @small
     * @author fsnaith
     * @group services
     * @group 202004
     */
    public function testConstruct()
    {
        // SCENARIO: Instantiate a new AbstractComparer instance.
        // EXPECT: The entity parameters are assigned as expected.

        // ACT

        $proxyAbstractComparer = new ProxyAbstractComparer($this->_entityA, $this->_entityB);

        // ASSERT

        $this->assertEquals($this->_entityA, $proxyAbstractComparer->testGetEntityA());
        $this->assertEquals($this->_entityB, $proxyAbstractComparer->testGetEntityB());
    }

    /**
     * @small
     * @author fsnaith
     * @group services
     * @group 202004
     */
    public function testGetEntityA()
    {
        // SCENARIO: Instantiate a new AbstractComparer (via Proxy class),
        //   skip the constructor and set entityA via test proxy method.
        // EXPECT: The getEntityA() method returns the expected entity.

        // ARRANGE

        $proxyAbstractComparer = $this->getMockBuilder(ProxyAbstractComparer::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['testSetEntityA', 'getEntityA'])
            ->getMock();

        // Set entityA
        $proxyAbstractComparer->testSetEntityA($this->_entityA);

        // ACT

        $result = $proxyAbstractComparer->getEntityA();

        // ASSERT

        $this->assertEquals($this->_entityA, $result);
    }

    /**
     * @small
     * @author fsnaith
     * @group services
     * @group 202004
     */
    public function testGetEntityB()
    {
        // SCENARIO: Instantiate a new AbstractComparer (via Proxy class),
        //   skip the constructor and set entityB via test proxy method.
        // EXPECT: The getEntityB() method returns the expected entity.

        // ARRANGE

        $proxyAbstractComparer = $this->getMockBuilder(ProxyAbstractComparer::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['setEntityB', 'testGetEntityB'])
            ->getMock();
        $this->assertNull($proxyAbstractComparer->testGetEntityB());

        // ACT

        $proxyAbstractComparer->setEntityB($this->_entityB);

        // ASSERT

        $this->assertEquals($this->_entityB, $proxyAbstractComparer->testGetEntityB());
    }

    /**
     * @small
     * @author fsnaith
     * @group services
     * @group 202004
     */
    public function testSetEntityA()
    {
        // SCENARIO: Instantiate a new AbstractComparer instance (via proxy class) and call setEntityA() with a valid parameter.
        // EXPECT: testGetEntityA() returns the entity.

        // ARRANGE

        $proxyAbstractComparer = $this->getMockBuilder(ProxyAbstractComparer::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['setEntityA', 'testGetEntityA'])
            ->getMock();
        $this->assertNull($proxyAbstractComparer->testGetEntityA());

        // ACT

        $proxyAbstractComparer->setEntityA($this->_entityA);

        // ASSERT

        $this->assertEquals($this->_entityA, $proxyAbstractComparer->testGetEntityA());
    }

    /**
     * @small
     * @author fsnaith
     * @group services
     * @group 202004
     */
    public function testSetEntityB()
    {
        // SCENARIO: Instantiate a new AbstractComparer instance (via proxy class) and call setEntityB() with a valid parameter.
        // EXPECT: testGetEntityB() returns the entity.

        // ARRANGE

        $proxyAbstractComparer = $this->getMockBuilder(ProxyAbstractComparer::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['setEntityB', 'testGetEntityB'])
            ->getMock();
        $this->assertNull($proxyAbstractComparer->testGetEntityB());

        // ACT

        $proxyAbstractComparer->setEntityB($this->_entityB);

        // ASSERT

        $this->assertEquals($this->_entityB, $proxyAbstractComparer->testGetEntityB());
    }
}

/**
 * Class ProxyAbstractComparer
 * @package Tests\App\Services\Comparers
 *
 * A test class to bypass the original class methods during testing.
 */
class ProxyAbstractComparer extends AbstractComparer
{
    public function compare() {}

    public function testSetEntityA($entity)
    {
        $this->_entityA = $entity;
    }
    public function testSetEntityB($entity)
    {
        $this->_entityB = $entity;
    }
    public function testGetEntityA()
    {
        return $this->_entityA;
    }
    public function testGetEntityB()
    {
        return $this->_entityB;
    }
}

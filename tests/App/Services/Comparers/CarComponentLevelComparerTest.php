<?php

namespace Tests\App\Services\Comparers;

use App\Models\Entities\CarComponentLevelEntity;
use App\Services\Comparers\AbstractComparer;
use App\Services\Comparers\CarComponentLevelComparer;
use PHPUnit\Framework\TestCase;


class CarComponentLevelComparerTest extends TestCase
{
    /**
     * @small
     * @author fsnaith
     * @group 202004
     * @group services
     */
    public function testCompare()
    {
        // SCENARIO: entityA and entityB are set on the class, then the compare() method is called.
        // EXPECT: All the getter methods are called on entityA & entityB,
        //  and the _diff* properties are updated as expected.

        // ARRANGE

        // Mock Entity A
        $entityA = $this->getMockBuilder(CarComponentLevelEntity::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityA->expects($this->once())->method('getStatAero')->will($this->returnValue(1));
        $entityA->expects($this->once())->method('getStatGrip')->will($this->returnValue(2));
        $entityA->expects($this->once())->method('getStatPitStop')->will($this->returnValue(3));
        $entityA->expects($this->once())->method('getStatPower')->will($this->returnValue(4));
        $entityA->expects($this->once())->method('getStatReliability')->will($this->returnValue(5));

        // Mock EntityB
        $entityB = $this->getMockBuilder(CarComponentLevelEntity::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityB->expects($this->once())->method('getStatAero')->will($this->returnValue(8));
        $entityB->expects($this->once())->method('getStatGrip')->will($this->returnValue(0));
        $entityB->expects($this->once())->method('getStatPitStop')->will($this->returnValue(299));
        $entityB->expects($this->once())->method('getStatPower')->will($this->returnValue(4));
        $entityB->expects($this->once())->method('getStatReliability')->will($this->returnValue(10));

        $mockCarComponentLevelComparer = $this->getMockBuilder(ProxyCarComponentLevelComparer::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['compare', 'setEntityA', 'setEntityB', 'getPropertyValues'])
            ->getMock();

        $mockCarComponentLevelComparer->setEntityA($entityA);
        $mockCarComponentLevelComparer->setEntityB($entityB);

        // ACT

        $mockCarComponentLevelComparer->compare();

        // Get the object properties
        $propertyValues = $mockCarComponentLevelComparer->getPropertyValues();

        // ASSERT

        // Ensure we're extended the Abstract class
        $this->assertInstanceOf(AbstractComparer::class, $mockCarComponentLevelComparer);

        $this->assertEquals(7, $propertyValues['_diffStatAero']);
        $this->assertEquals(-2, $propertyValues['_diffStatGrip']);
        $this->assertEquals(296, $propertyValues['_diffStatPitStop']);
        $this->assertEquals(0, $propertyValues['_diffStatPower']);
        $this->assertEquals(5, $propertyValues['_diffStatReliability']);
    }

    /**
     * @small
     * @author fsnaith
     * @group 202004
     * @group services
     */
    public function testDiffStatGetters()
    {
        // SCENARIO: The protected _diffStat* properties are assigned values.
        // EXPECT: All the getter methods return the expected values.

        // ARRANGE

        $values = [1, 3, 7, 11, 13];

        $mockCarComponentLevelComparer = $this->getMockBuilder(ProxyCarComponentLevelComparer::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept([
                'setProperties', 'getDiffStatAero', 'getDiffStatGrip',
                'getDiffStatPitStop', 'getDiffStatPower', 'getDiffStatReliability'
            ])->getMock();

        $mockCarComponentLevelComparer->setProperties($values);

        // ACT & ASSERT

        $this->assertEquals(1, $mockCarComponentLevelComparer->getDiffStatAero());
        $this->assertEquals(3, $mockCarComponentLevelComparer->getDiffStatGrip());
        $this->assertEquals(7, $mockCarComponentLevelComparer->getDiffStatPitStop());
        $this->assertEquals(11, $mockCarComponentLevelComparer->getDiffStatPower());
        $this->assertEquals(13, $mockCarComponentLevelComparer->getDiffStatReliability());
    }
}
class ProxyCarComponentLevelComparer extends CarComponentLevelComparer
{
    public function getPropertyValues()
    {
        return get_object_vars($this);
    }

    public function setProperties($array)
    {
        $this->_diffStatAero = $array[0];
        $this->_diffStatGrip = $array[1];
        $this->_diffStatPitStop = $array[2];
        $this->_diffStatPower = $array[3];
        $this->_diffStatReliability = $array[4];
    }
}

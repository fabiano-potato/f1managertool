<?php

namespace Tests\App\Services\CarComponents;

use App\Contracts\Repositories\CarComponentLevelRepositoryInterface;
use App\Contracts\Repositories\CarComponentRepositoryInterface;
use App\Contracts\Repositories\UserCarComponentRepositoryInterface;
use App\Models\Entities\CarComponentEntity;
use App\Models\Entities\CarComponentLevelEntity;
use App\Models\Entities\UserCarComponentEntity;
use App\Services\CarComponents\CarComponentAssigner;
use Tests\TestCase;

class CarComponentAssignerTest extends TestCase
{
    /**
     * @small
     * @author fsnaith
     * @group 202004
     * @group services
     * @dataProvider _dataFor_TestAssign
     */
    public function testAssign($expectedException,
                               $expectedResult,
                               $carComponentFindReturn,
                               $carComponentLevelFindReturn,
                               $userCarComponentFindReturn,
                               $findUserCarComponentEntityReturn,
                               $userId,
                               $carComponentLevelId)
    {
        if ($expectedException) {
            $this->expectException('Error');
        }

        // Mock CarComponentEntity
        $mockCarComponentEntity = $this->getMockBuilder(CarComponentEntity::class)
            ->disableOriginalConstructor()->getMock();

        // Mock CarComponentLevelEntity
        $mockCarComponentLevelEntity = $this->getMockBuilder(CarComponentLevelEntity::class)
            ->disableOriginalConstructor()->getMock();

        // Mock CarComponentLevelRepository
        $mockCarComponentLevelRepository = $this->getMockBuilder(CarComponentLevelRepositoryInterface::class)
            ->disableOriginalConstructor()->getMock();

        // Mock CarComponentRepository
        $mockCarComponentRepository = $this->getMockBuilder(CarComponentRepositoryInterface::class)
            ->disableOriginalConstructor()->getMock();

        // Mock UserCarComponentEntity
        $mockUserCarComponentEntity = $this->getMockBuilder(UserCarComponentEntity::class)
            ->disableOriginalConstructor()->getMock();

        // Mock UserCarComponentRepositoryInterface
        $mockUserCarComponentRepositoryInterface = $this->getMockBuilder(UserCarComponentRepositoryInterface::class)
            ->disableOriginalConstructor()->getMock();

        // Mock CarComponentAssigner
        $mockCarComponentAssigner = $this->getMockBuilder(ProxyCarComponentAssigner::class)
            ->disableOriginalConstructor()->setMethodsExcept([
                'assign', 'setUserCarComponentRepository', 'setCarComponentRepository', 'setCarComponentLevelRepository',
            ])->getMock();

        // Now assert flow

        $mockCarComponentLevelRepository->expects($this->once())
            ->method('findById')
            ->with($carComponentLevelId)
            ->will($this->returnValue($carComponentLevelFindReturn ? $mockCarComponentLevelEntity : false));

        if ($carComponentLevelFindReturn) {
            // findById() returns the $mockCarComponentLevelEntity

            $mockCarComponentLevelEntity->expects($this->once())->method('getCarComponentId')->will($this->returnValue(5555555));

            $mockCarComponentRepository->expects($this->once())->method('findById')->with(5555555)
                ->will($this->returnValue($carComponentFindReturn ? $mockCarComponentEntity : false));

            if ($carComponentFindReturn) {
                // findById() returns $mockCarComponentEntity

                $mockCarComponentEntity->expects($this->any())->method('getType')->will($this->returnValue(999));
                $mockCarComponentEntity->expects($this->any())->method('getCarComponentId')->will($this->returnValue(987654321));

                $mockUserCarComponentRepositoryInterface->expects($this->once())
                    ->method('unassignComponentsForType')
                    ->with($userId, 999);

                $mockCarComponentAssigner->expects($this->once())->method('_findUserCarComponentEntity')
                    ->with($userId, 987654321)
                    ->will($this->returnValue($findUserCarComponentEntityReturn ? $mockUserCarComponentEntity : false));

                if ($userCarComponentFindReturn) {
                    $mockUserCarComponentEntity->expects($this->once())->method('setIsAssigned')->with(true)->will($this->returnSelf());

                    // Ensure update() is called on the CarComponentEntity
                    $mockCarComponentAssigner->expects($this->once())->method('update')
                        ->with($mockUserCarComponentEntity)
                        ->will($this->returnValue('updateReturnValue'));
                }
                else {
                    $mockCarComponentAssigner->expects($this->once())->method('_createNewAssigned')
                        ->with($userId, 987654321, 999)
                        ->will($this->returnValue('createNewAssignedReturnValue'));
                }
            }
        }

        $mockCarComponentAssigner->setUserCarComponentRepository($mockUserCarComponentRepositoryInterface)
            ->setCarComponentRepository($mockCarComponentRepository)
            ->setCarComponentLevelRepository($mockCarComponentLevelRepository);

        // ACT

        $result = $mockCarComponentAssigner->assign($userId, $carComponentLevelId);

        // ASSERT

        $this->assertEquals($expectedResult, $result);
    }
    public function _dataFor_TestAssign()
    {
        $tests = [];

        // SCENARIO: findById() called on the CarComponentLevelRepository returns false.
        // EXPECT: Exception is thrown
        $tests[] = [
            true, // $expectedException,
            null, // $expectedResult,
            null, // $carComponentFindReturn,
            false, // $carComponentLevelFindReturn,
            null, // $findUserCarComponentEntityReturn
            null, // $userCarComponentFindReturn,
            444555666, // $userId,
            777888999, // $carComponentLevelId
        ];

        // SCENARIO: findById() called on the CarComponentRepository returns false.
        // EXPECT: Exception is thrown
        $tests[] = [
            true, // $expectedException,
            null, // $expectedResult,
            false, // $carComponentFindReturn,
            true, // $carComponentLevelFindReturn,
            null, // $userCarComponentFindReturn,
            null, // $findUserCarComponentEntityReturn
            444555666, // $userId,
            777888999, // $carComponentLevelId
        ];

        // SCENARIO: All entities are found.
        // EXPECT: unassignComponentsForType() is called, update() is called on an assigned entity
        $tests[] = [
            false, // $expectedException,
            true, // $expectedResult,
            true, // $carComponentFindReturn,
            true, // $carComponentLevelFindReturn,
            true, // $userCarComponentFindReturn,
            null, // $findUserCarComponentEntityReturn
            444555666, // $userId,
            777888999, // $carComponentLevelId
        ];


        return $tests;
    }

    /**
     * @small
     * @author fsnaith
     * @group 202004
     * @group services
     */
    public function testFindUserCarComponentEntity()
    {
        // SCENARIO: findUserCarComponentEntity() is called.
        // EXPECT: Expected methods are called on the _userCarComponentRepository.

        // ARRANGE

        $userId = 92582582;
        $carComponentId = 15125823;

        // Mock UseCarComponentEntity
        $mockUserCarComponentEntity = $this->getMockBuilder(UserCarComponentEntity::class)
            ->disableOriginalConstructor()->getMock();

        // Mock CarComponentAssigner
        $mockCarComponentAssigner = $this->getMockBuilder(ProxyCarComponentAssigner::class)
            ->disableOriginalConstructor()
        ->setMethodsExcept(['proxyFindUserCarComponentEntity', '_findUserCarComponentEntity', 'setUserCarComponentRepository'])
            ->getMock();

        // Mock UserCarComponentRepositoryInterface
        $mockUserCarComponentRepositoryInterface = $this->getMockBuilder(UserCarComponentRepositoryInterface::class)
            ->disableOriginalConstructor()->getMock();

        $mockUserCarComponentRepositoryInterface->expects($this->once())
            ->method('filterUserId')
            ->with($userId)
            ->will($this->returnSelf());
        $mockUserCarComponentRepositoryInterface->expects($this->once())
            ->method('filterCarComponentId')
            ->with($carComponentId)
            ->will($this->returnSelf());
        $mockUserCarComponentRepositoryInterface->expects($this->once())
            ->method('findOne')
            ->will($this->returnValue($mockUserCarComponentEntity));

        $mockCarComponentAssigner->setUserCarComponentRepository($mockUserCarComponentRepositoryInterface);

        // ACT

        $result = $mockCarComponentAssigner->proxyFindUserCarComponentEntity($userId, $carComponentId);

        // ASSERT

        $this->assertEquals($mockUserCarComponentEntity, $result);
    }
}
class ProxyCarComponentAssigner extends CarComponentAssigner
{
    public function setUserCarComponentRepository($repo)
    {
        $this->_userCarComponentRepository = $repo;
        return $this;
    }

    public function setCarComponentLevelRepository($repo)
    {
        $this->_carComponentLevelRepository = $repo;
        return $this;
    }

    public function setCarComponentRepository($repo)
    {
        $this->_carComponentRepository = $repo;
        return $this;
    }

    public function proxyFindUserCarComponentEntity($userId, $carComponentId)
    {
        return $this->_findUserCarComponentEntity($userId, $carComponentId);
    }
}

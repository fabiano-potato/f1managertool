<?php

namespace Tests\Unit\database\seeds;

use PHPUnit\Framework\TestCase;

require('../../../../database/seeds/CarComponentSeeder.php');

class CarComponentSeederTest extends TestCase
{
    protected $_standardCarComponentCsvData = <<<CSV
The Anchor,1,2,3,4,5,6,7,8,9,10
Upgrade Cost,2.000,6.800,16.000,32.000,54.000,86.000,128.000,,,
Power,9,9,9,10,10,10,10,10,,
Aero,1,1,2,2,4,4,5,5,,
Grip,4,6,6,6,7,7,11,13,,
Reliability,3,3,3,3,4,4,5,5,,
Pit Stop,"1,15","1,05","1,05","1,02","1,02","1,01","1,01","0,93",,
Card Required,4,10,20,50,100,200,400,0,,
CSV;

    protected $_stockCarComponentCsvData = <<<CSV
Brakes Starter,1,2,3,4,5,6,7,8,9,10
Upgrade Cost,,,,,,,,,,
Power,80,,,,,,,,,
Aero,39,,,,,,,,,
Grip,32,,,,,,,,,
Reliability,29,,,,,,,,,
CSV;


    /**
     * @small
     * @author fsnaith
     * @group 202004
     * @dataProvider _dataFor_testProcessFileContents
     */
    public function testProcessFileContents($expectedResult, $fileContents)
    {
        // ARRANGE

        $mockSeeder = $this->getMockBuilder(ProxyCarComponentSeeder::class)
            ->setMethodsExcept(['_processFileContent'])
            ->disableOriginalConstructor()
            ->getMock();

        // ACT

        $result = $mockSeeder->proxyProcessFileContents($fileContents);

        // ASSERT

        $this->assertEquals($expectedResult, $result);
    }
    public function _dataFor_testProcessFileContents()
    {
        $tests = [];

        // SCENARIO: Process a non stock component csv file.
        // EXPECT: Results to be a nested array of data for the carComponentLevel entities and their parent carCompoment
        $tests[] = [
            [
                'name' => 'The Anchor',
                'levels' => [
                    "levels" => [
                        [
                            "level" => 1,
                            "statPower" => 9,
                            "statAero" => 1,
                            "statGrip" => 4,
                            "statReliability" => 3,
                            "statPitStop" => 1.15,
                            "upgradeCost" => 2000,
                            "requiredUpgradePoints" => 4
                        ],
                        [
                            "level" => 2,
                            "statPower" => 9,
                            "statAero" => 1,
                            "statGrip" => 6,
                            "statReliability" => 3,
                            "statPitStop" => 1.05,
                            "upgradeCost" => 6800,
                            "requiredUpgradePoints" => 4
                        ],
                        [
                            "level" => 3,
                            "statPower" => 9,
                            "statAero" => 2,
                            "statGrip" => 6,
                            "statReliability" => 3,
                            "statPitStop" => 1.05,
                            "upgradeCost" => 16000,
                            "requiredUpgradePoints" => 20
                        ],
                        [
                            "level" => 4,
                            "statPower" => 10,
                            "statAero" => 2,
                            "statGrip" => 6,
                            "statReliability" => 3,
                            "statPitStop" => 1.02,
                            "upgradeCost" => 32000,
                            "requiredUpgradePoints" => 50
                        ],
                        [
                            "level" => 5,
                            "statPower" => 10,
                            "statAero" => 4,
                            "statGrip" => 7,
                            "statReliability" => 4,
                            "statPitStop" => 1.02,
                            "upgradeCost" => 54000,
                            "requiredUpgradePoints" => 100
                        ],
                        [
                            "level" => 6,
                            "statPower" => 10,
                            "statAero" => 4,
                            "statGrip" => 7,
                            "statReliability" => 4,
                            "statPitStop" => 1.01,
                            "upgradeCost" => 86000,
                            "requiredUpgradePoints" => 200
                        ],
                        [
                            "level" => 7,
                            "statPower" => 10,
                            "statAero" => 5,
                            "statGrip" => 11,
                            "statReliability" => 5,
                            "statPitStop" => 1.01,
                            "upgradeCost" => 128000,
                            "requiredUpgradePoints" => 400
                        ],
                        [
                            "level" => 8,
                            "statPower" => 10,
                            "statAero" => 5,
                            "statGrip" => 13,
                            "statReliability" => 5,
                            "statPitStop" => 0.93,
                            "upgradeCost" => 0,
                            "requiredUpgradePoints" => 0
                        ]
                    ]
                ],
            ], // $expectedResults
            $this->_standardCarComponentCsvData, // $fileContents
        ];

        return $tests;
    }
}
class ProxyCarComponentSeeder extends CarComponentSeeder
{
    public function proxyProcessFileContents($fileContents)
    {
        return $this->_processFileContents($fileContents);
    }
}

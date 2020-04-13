<?php

use App\Contracts\Repositories\DriverLevelRepositoryInterface;
use App\Contracts\Repositories\DriverRepositoryInterface;
use App\Models\Entities\DriverEntity;
use App\Models\Entities\DriverLevelEntity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DriverSeeder extends Seeder
{
    /**
     * @var DriverRepositoryInterface
     */
    protected $_driverRepository;

    /**
     * @var DriverLevelRepositoryInterface
     */
    protected $_driverLevelRepository;

    /**
     * DriverSeeder constructor.
     * @param DriverRepositoryInterface $driverRepository
     * @param DriverLevelRepositoryInterface $driverLevelRepository
     */
    public function __construct(DriverRepositoryInterface $driverRepository, DriverLevelRepositoryInterface $driverLevelRepository)
    {
        $this->_driverRepository = $driverRepository;
        $this->_driverLevelRepository = $driverLevelRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dirPath = storage_path() . '/data/drivers/';
        if (!File::exists($dirPath)) {
            throw new RuntimeException('Driver seed filepath doesn\'t exist: ' . $dirPath);
        }

        // Get the files from the dir
        $files = File::files($dirPath);

        if (!$files) {
            echo 'No Driver seed files exist.' . PHP_EOL;
        }
        foreach ($files as $file) {
            try {
                $data = $this->_processFileContents($file);

                // Create the Entity
                $driverEntity = new DriverEntity();
                $driverEntity->setName($data['name']);
                $success = $this->_driverRepository->create($driverEntity);
                if (!$success) {
                    echo "Couldn't create Driver: " . $data['name'] . PHP_EOL;
                    continue;
                }

                // Save level data
                foreach ($data['levels'] as $levelData) {
                    $driverLevelEntity = new DriverLevelEntity();
                    $driverLevelEntity->setDriverId($driverEntity->getDriverId());
                    $driverLevelEntity->fromArray($levelData);
                    $success = $this->_driverLevelRepository->create($driverLevelEntity);
                    if (!$success) {
                        echo sprintf(
                            "Couldn't create driverLevel %d for driver: %s",
                            $levelData['level'],
                            $driverEntity->getName()
                        );
                    }
                }
            }
            catch (Exception $e)
            {
                echo "Couldn't create Driver: " . $data['name'] . PHP_EOL;
                echo $e->getMessage() . PHP_EOL;
            }
        }
    }

    /**
     * Process the file contents into a nested array of data
     *
     * @param $filepath
     * @return array
     */
    protected function _processFileContents($filepath)
    {
        $file = fopen($filepath, "r");

        // These CSV files are populated vertically, meaning the driver level data is populated over rows, instead of
        // across columns in a single row.
        $data = fgetcsv($file);
        $entityData = [
            'name' => array_shift($data),
            'levels' => []
        ];

        // Loop and add levels
        foreach ($data as $level) {
            $entityData['levels'][$level] = ['level' => $level];
        }

        // Add Upgrade Cost
        $data = fgetcsv($file);
        foreach ($entityData['levels'] as $level => &$levelData) {
            $levelData['upgradeCost'] = str_replace('.', '', $data[$level]) ?: 0;
        }

        // Add Overtaking
        $data = fgetcsv($file);
        foreach ($entityData['levels'] as $level => &$levelData) {
            if (!$data[$level]) {
                // This level doesn't exist if the stat doesn't exist, remove it from the data.
                unset($entityData['levels'][$level]);
            }
            else {
                $levelData['statOvertaking'] = $data[$level];
            }
        }

        // Add the remaining stats
        foreach (
            ['statDefending', 'statConsistency', 'statFuelManagement', 'statTyreManagement', 'statWetWeather', 'upgradePoints']
            as $statName
        ) {
            $data = fgetcsv($file);
            foreach ($entityData['levels'] as $level => &$levelData) {
                $levelData[$statName] = $data[$level];
            }
        }

        return $entityData;
    }
}

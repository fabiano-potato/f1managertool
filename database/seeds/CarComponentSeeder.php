<?php

use App\Models\Entities\CarComponentEntity;
use App\Models\Entities\CarComponentLevelEntity;
use App\Providers\RepositoryServiceProvider;
use App\Repositories\Eloquent\CarComponentLevelRepository;
use App\Repositories\Eloquent\CarComponentRepository;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

/**
 * Class CarComponentSeeder
 *
 * Seed the database for CarComponent and CarComponentLevel modesl.
 * There is one file per CarComponent including all its CarComponentLevels
 */
class CarComponentSeeder extends Seeder
{
    protected static $_typeDirMap = [
        CarComponentEntity::TYPE_BRAKES => 'brakes',
        CarComponentEntity::TYPE_GEARBOX => 'gearbox',
        CarComponentEntity::TYPE_REAR_WING => 'rear_wing',
        CarComponentEntity::TYPE_FRONT_WING => 'front_wing',
        CarComponentEntity::TYPE_SUSPENSION => 'suspension',
        CarComponentEntity::TYPE_ENGINE => 'engine',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CarComponentRepository $carComponentRepository,
                        CarComponentLevelRepository $carComponentLevelRepository)
    {
        // Read files from the directory types
        foreach (self::$_typeDirMap as $type => $dirName) {
            $dirPath = storage_path() . '/data/car_components/' . $dirName;
            if (!File::exists($dirPath)) {
                continue; // Directory doesn't exist
            }

            // Get the files from the dir
            $files = File::files($dirPath);

            if (!$files) {
                continue;
            }
            foreach ($files as $file) {
                $data = $this->_processFileContents(File::get($file));

                // Create the Car Component
                $carComponentEntity = new CarComponentEntity();
                $carComponentEntity->setType($type);
                $carComponentEntity->setName($data['name']);
                $success = $carComponentRepository->create($carComponentEntity);
                if (!$success) {
                    echo "Couldn't create carComponent for type: " . $type . PHP_EOL;
                    continue;
                }

                // Save level data
                foreach ($data['levels'] as $levelData) {
                    $carComponentLevelEntity = new CarComponentLevelEntity();
                    $carComponentLevelEntity->setCarComponentId($carComponentEntity->getCarComponentId());
                    $carComponentLevelEntity->fromArray($levelData);
                    $success = $carComponentLevelRepository->create($carComponentLevelEntity);
                    if (!$success) {
                        echo sprintf(
                            "Couldn't create carComponentLevel %d for component: %s",
                            $levelData['level'],
                            $carComponentEntity->getName()
                        );
                    }
                }
            }
        }
    }

    /**
     * Process the file contents into a nested array of data
     *
     * @param $contents
     * @return array
     */
    protected function _processFileContents($contents)
    {
        $data = str_getcsv($contents);
        $componentData = [
            'name' => $data[0],
        ];

        // Loop the 10 component levels of data
        for ($i=1; $i<=9; $i++) {
            if (!$data[$i + 20]) {
                continue; // If there's no power stat there's no component level data
            }
            $levelData = [
                'level' => $data[$i],
                'upgradeCost' => str_replace('.', '', $data[$i + 10]) ?: 0,
                'statPower' => $data[$i + 20],
                'statAero' => $data[$i + 30],
                'statGrip' => $data[$i + 40],
                'statReliability' => $data[$i + 50],
                'statPitStop' => 0,
                'requiredUpgradePoints' => 0,
            ];

            // Set the statPitStop data if it exists (not available for stock components
            if (key_exists(($i + 60), $data)) {
                $levelData['statPitStop'] = str_replace(',', '.', $data[$i + 60]);
            }

            // Set the requireUpgradePoints data if it exists (not available for stock components
            if (key_exists(($i + 70), $data)) {
                $levelData['requiredUpgradePoints'] = $data[$i + 70];
            }

            $componentData['levels'][] = $levelData;
        }

        return $componentData;
    }
}

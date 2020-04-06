<?php

use App\Models\Entities\CarComponentEntity;
use App\Models\Entities\CarComponentLevelEntity;
use App\Repositories\Eloquent\CarComponentLevelRepository;
use App\Repositories\Eloquent\CarComponentRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param CarComponentRepository $carComponentRepository
     * @param CarComponentLevelRepository $carComponentLevelRepository
     * @return void
     */
    public function run(CarComponentRepository $carComponentRepository, CarComponentLevelRepository $carComponentLevelRepository)
    {
        $json = $json = File::get("database/data/car_components_data.json");
        $data = json_decode($json, true);
        foreach ($data as $componentData) {
            $entity = new CarComponentEntity();
            $entity->fromArray($componentData);
            $carComponentRepository->create($entity);

            // Create Levels
            if (isset($componentData['levels'])) {
                foreach ($componentData['levels'] as $levelData) {
                    $levelEntity = new CarComponentLevelEntity();
                    $levelEntity->fromArray($levelData);
                    $levelEntity->setCarComponentId($entity->getCarComponentId());
                    $carComponentLevelRepository->create($levelEntity);
                }
            }
        }
    }
}

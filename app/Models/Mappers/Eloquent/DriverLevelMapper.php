<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Eloquent\EloquentDriverLevelModel;
use App\Models\Entities\DriverLevelEntity;

/**
 * Class DriverLevelMapper
 * @package App\Models\Mappers\Eloquent
 */
Class DriverLevelMapper extends AbstractEloquentMapper
{
    /**
     * A map of Entity property names to model property names
     *
     * @var array
     */
    protected static $_entityModelPropertyMap = [
        'driverLevelId' => 'driver_level_id',
        'driverId' => 'driver_id',
        'level' => 'level',
        'statOvertaking' => 'stat_overtaking',
        'statDefending' => 'stat_defending',
        'statConsistency' => 'stat_consistency',
        'statFuelManagement' => 'stat_fuel_management',
        'statTyreManagement' => 'stat_tyre_management',
        'statWetWeather' => 'stat_wet_weather',
        'upgradePoints' => 'upgrade_points',
        'upgradeCost' => 'upgrade_cost',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    /**
     * Map the model to entity
     *
     * @param EloquentDriverLevelModel $model
     * @param DriverLevelEntity $entity
     * @return DriverLevelEntity
     */
    public function toEntity(EloquentDriverLevelModel $model, DriverLevelEntity $entity = null): DriverLevelEntity
    {
        if (!$entity) {
            $entity = new DriverLevelEntity();
        }
        /* @var DriverLevelEntity $entity */
        $entity = parent::_toEntity($model, $entity);
        return $entity;
    }

    /**
     * Convert a DriverLevel to an EloquentDriverLevelModel
     *
     * @param DriverLevelEntity $entity
     * @return EloquentDriverLevelModel
     */
    public function toModel(DriverLevelEntity $entity): EloquentDriverLevelModel
    {
        /* @var EloquentDriverLevelModel $model */
        $model = parent::_toModel($entity, new EloquentDriverLevelModel());
        return $model;
    }
}

<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Eloquent\EloquentCarComponentLevelModel;
use App\Models\Entities\CarComponentLevelEntity;

/**
 * Class CarComponentLevelMapper
 * This class maps the eloquent model to it's entity and vice versa.
 *
 * @package App\Models\Eloquent\Mappers
 */
class CarComponentLevelMapper extends AbstractEloquentMapper
{
    /**
     * A map of Entity property names to model property names
     *
     * @var array
     */
    public static $_entityModelPropertyMap = [
        'carComponentLevelId' => 'car_component_level_id',
        'carComponentId' => 'car_component_id',
        'level' => 'level',
        'upgradeCost' => 'upgrade_cost',
        'statPower' => 'stat_power',
        'statAero' => 'stat_aero',
        'statGrip' => 'stat_grip',
        'statReliability' => 'stat_reliability',
        'statPitStop' => 'stat_pit_stop',
        'requiredUpgradePoints' => 'required_upgrade_points',
        'createdAt' => 'created_at',
        'updateAt' => 'updated_at',
    ];

    /**
     * Map the model to entity
     *
     * @param EloquentCarComponentLevelModel $model
     * @param CarComponentLevelEntity|null $entity
     * @return CarComponentLevelEntity
     */
    public function toEntity(EloquentCarComponentLevelModel $model, CarComponentLevelEntity $entity = null): CarComponentLevelEntity
    {
        if (!$entity) {
            $entity = new CarComponentLevelEntity();
        }
        return parent::_toEntity($model, $entity);
    }
}

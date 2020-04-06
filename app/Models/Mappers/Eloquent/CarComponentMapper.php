<?php

namespace App\Models\Mappers\Eloquent;

use App\Models\Mappers\CarComponentMapperInterface;

/**
 * Class CarComponentMapper
 * This class maps the eloquent model to it's entity and vice versa.
 *
 * @package App\Models\Eloquent\Mappers
 */
class CarComponentMapper extends AbstractEloquentMapper implements CarComponentMapperInterface
{
    /**
     * A map of Entity property names to model property names
     *
     * @var array
     */
    protected static $_entityModelPropertyMap = [
        'carComponentId' => 'car_component_id',
        'name' => 'name',
        'type' => 'type',
        'createdAt' => 'created_at',
        'updateAt' => 'updated_at',
    ];
}

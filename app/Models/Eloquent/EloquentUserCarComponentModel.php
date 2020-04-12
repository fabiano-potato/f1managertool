<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentUserCarComponentModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_car_components';

    /**
     * The name of the primary key field.
     *
     * @var string
     */
    protected $primaryKey = 'user_car_components_id';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'car_component_id',
        'current_level',
        'car_component_type',
        'current_upgrade_points',
        'is_assigned',
        'updated_at',
        'created_at',
    ];
}

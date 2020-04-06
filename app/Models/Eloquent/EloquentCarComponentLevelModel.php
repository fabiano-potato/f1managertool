<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentCarComponentLevelModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_component_levels';

    /**
     * The name of the primary key field
     *
     * @var string
     */
    protected $primaryKey = 'car_component_level_id';
}

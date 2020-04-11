<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentDriverLevelModel
 * @package App\Models\Eloquent
 */
class EloquentDriverLevelModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'driver_levels';

    /**
     * The name of the primary key field.
     *
     * @var string
     */
    protected $primaryKey = 'driver_level_id';
}

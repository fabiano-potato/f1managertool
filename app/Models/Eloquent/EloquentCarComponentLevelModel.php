<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * The CarComponentLevel that this instance belongs to.
     *
     * @return BelongsTo
     */
    public function carComponent()
    {
        return $this->belongsTo('App\Models\Eloquent\EloquentCarComponentModel', 'car_component_id', 'car_component_id');
    }
}

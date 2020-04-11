<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class EloquentCarComponentModel
 * @package App\Models\Eloquent
 */
class EloquentCarComponentModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_components';

    /**
     * The name of the primary key field.
     *
     * @var string
     */
    protected $primaryKey = 'car_component_id';

    /**
     * Get the CarComponentLevels for this CarComponent
     *
     * @return HasMany
     */
    public function carComponentLevels()
    {
        return $this->hasMany('App\Models\Eloquent\EloquentCarComponentLevels');
    }
}

<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

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
     * The name of the primary key field
     *
     * @var string
     */
    protected $primaryKey = 'car_component_id';
}

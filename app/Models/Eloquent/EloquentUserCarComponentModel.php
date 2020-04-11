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
}

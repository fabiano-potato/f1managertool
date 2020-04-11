<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentDriverModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'drivers';

    /**
     * The name of the primary key field.
     *
     * @var string
     */
    protected $primaryKey = 'driver_id';
}

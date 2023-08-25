<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelAllocationModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "fuel_allocation";
    protected $primaryKey = "id";
    protected $foreignKey = "vehicle_id";
    protected $fillable = ['vehicle_id', 'user_id', 'meter', 'time', 'reference', 'provience', 'note', 'qty', 'complete', 'date', 'mileage_type'];

    public function vehicle_data()
    {
        return $this->belongsTo("App\Model\VehicleModel", "vehicle_id", "id")->withTrashed();
    }

}

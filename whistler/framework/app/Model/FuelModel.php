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

class FuelModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "fuel";
    protected $fillable = ['user_id', 'start_meter', 'note', 'qty', 'fuel_from', 'cost_per_unit', 'date', 'vendor_name', 'mileage_type'];

    public function vehicle_data()
    {
        return $this->belongsTo("App\Model\VehicleModel", "vehicle_id", "id")->withTrashed();
    }
    public function vendor() {
        return $this->belongsTo('App\Model\Vendor', "vendor_name", "id")->withTrashed();
    }
}

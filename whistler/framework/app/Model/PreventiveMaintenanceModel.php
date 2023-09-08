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

class PreventiveMaintenanceModel extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "preventive_maintenance";
    protected $fillable = ['vehicle_id', 'service_item_id', 'parts_id', 'quantity', 'price', 'deviation', 'last_date', 'last_meter', 'user_id', 'recipients'];

    public function services()
    {
        return $this->hasOne("App\Model\ServiceItemsModel", "id", "service_item_id")->withTrashed();
    }

    public function vehicle() {
        return $this->belongsTo("App\Model\VehicleModel", "vehicle_id", "id")->with('vehicleData')->withTrashed();
    }

    public function parts() {
        return $this->belongsTo("App\Model\PartsModel", "parts_id", "id")->withTrashed();
    }
}

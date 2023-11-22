<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class VehicleMeterModel extends Pivot
{

    protected $table = "vehicle_meter";
    protected $fillable = ['start_meter', 'vehicle_id'];
    // public $incrementing = true;
    public $timestamps = false;
    public function vehicle()
    {
        return $this->hasOne("App\Model\VehicleModel", "id", "vehicle_id")->withTrashed();
    }

}

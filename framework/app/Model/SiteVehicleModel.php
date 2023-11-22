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

class SiteVehicleModel extends Pivot
{

    protected $table = "site_vehicle";
    protected $fillable = ['site_id', 'vehicle_id'];
    public $incrementing = true;
    public $timestamps = true;
    public function vehicle()
    {
        return $this->hasOne("App\Model\VehicleModel", "id", "vehicle_id")->withTrashed();
    }

    public function assigned_site()
    {
        return $this->hasOne("App\Model\User", "id", "site_id")->withTrashed();
    }
}

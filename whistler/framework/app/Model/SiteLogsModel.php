<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiteLogsModel extends Model
{

    protected $table = 'site_logs';
    protected $fillable = ['site_id', 'vehicle_id', 'date'];

    public function vehicle()
    {
        return $this->hasOne("App\Model\VehicleModel", "id", "vehicle_id")->withTrashed();
    }

    public function site()
    {
        return $this->hasOne("App\Model\ProductYield", "id", "site_id")->withTrashed();
    }
}

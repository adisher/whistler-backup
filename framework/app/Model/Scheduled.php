<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scheduled extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'reports_scheduled';
    protected $fillable = ['user_id', 'vehicle_id', 'status', 'description', 'meter', 'reference'];

    public function vehicle()
    {
        return $this->belongsTo("App\Model\VehicleModel", "vehicle_id", "id")->withTrashed();
    }
    public function sites()
    {
        return $this->belongsTo('App\Model\ProductYield', 'site_id');
    }

    public function vendor()
    {
        return $this->belongsTo("App\Model\Vendor", "vendor_id", "id")->withTrashed();
    }

    public function mechanic()
    {
        return $this->belongsTo("App\Model\Mechanic", "mechanic_id", "id")->withTrashed();
    }

    public function parts()
    {
        return $this->hasMany("App\Model\PartsUsedModel", "work_id", "id");
    }

}

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

class WorkOrders extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'work_orders';
    protected $fillable = ['user_id', 'vehicle_id', 'status', 'description', 'reference'];

    public function vehicle()
    {
        return $this->belongsTo("App\Model\VehicleModel", "vehicle_id", "id")->with('vehicleData')->withTrashed();
    }
    public function sites()
    {
        return $this->belongsTo('App\Model\Site', 'site_id');
    }

    public function shift()
    {
        return $this->belongsTo('App\Model\Shift', 'shift_id');
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
    
    public function assigned_driver()
    {
        return $this->hasOne("App\Model\User", "id", "driver_id")->withTrashed();
    }

    public function shiftDetails()
    {
        return $this->hasMany("App\Model\ShiftDetails", 'site_id', 'site_id') // Connect site_id in both tables
            ->whereHas('vehicles', function ($query) {
                $query->where('vehicle_id', $this->vehicle_id); // Match the vehicle
            });
    }

}

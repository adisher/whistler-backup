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

class VehicleData extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'vehicle_data';
    protected $fillable = ['make', 'model', 'type_id', 'engine_type', 'engine_capacity', 'fuel_capacity', 'oil_capacity', 'horse_power', 'isenable'];

    public function types()
    {
        return $this->hasOne("App\Model\VehicleTypeModel", "id", "type_id")->withTrashed();
    }
    public function makeModel()
    {
        return $this->hasMany('App\Model\VehicleModel', 'make_model_id', 'id');
    }
}

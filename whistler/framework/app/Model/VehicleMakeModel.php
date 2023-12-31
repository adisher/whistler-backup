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

class VehicleMakeModel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'vehicle_make';
    protected $fillable = ['make', 'isenable'];
}

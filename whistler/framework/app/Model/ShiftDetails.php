<?php

namespace App\Model;

use App\Model\SiteVehicleModel;
use App\Model\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftDetails extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "shift_details";
    protected $primaryKey = 'id';
    protected $fillable = [
        'site_id',
        'shift_id',
        'vehicle_id',
        'date',
        'daily_quantity_grams',
        'daily_quantity_pounds',
        'daily_quantity_kgs',
        'wastage',
        'shift_yield_details',
        'shift_quantity_grams',
        'shift_quantity_pounds',
        'yield_quality',
        'work_hours',
        'net_weight_grams',
        'net_weight_pounds',
        'net_weight_kgs',
        'files',
        'custom_field',
        'deleted_at',
        'status',
    ];
    // Define the incharge relation
    public function incharge()
    {
        return $this->belongsTo(User::class, 'shift_incharge_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany('App\Model\Site', 'site_vehicle', 'vehicle_id', 'site_id')->using(SiteVehicleModel::class);
    }
    public function timeSlots()
    {
        return $this->hasMany('App\Model\TimeSlot');
    }
    public function site()
    {
        return $this->belongsTo('App\Model\Site', 'site_id');
    }
    public function shift()
    {
        return $this->belongsTo('App\Model\Shift', 'shift_id');
    }
}

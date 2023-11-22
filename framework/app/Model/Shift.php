<?php

namespace App\Model;

use App\Model\SiteVehicleModel;
use App\Model\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "shifts";
    protected $primaryKey = 'id';
    protected $fillable = [
        'site_id',
        'shift_name',
        'shift_details',
        'shift_incharge_id',
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
    public function shiftDetails()
    {
        return $this->hasMany('App\Model\ShiftDetails', 'shift_id');
    }
}

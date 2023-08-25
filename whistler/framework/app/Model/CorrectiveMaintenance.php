<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CorrectiveMaintenance extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "corrective_maintenance";
    protected $fillable = ['vehicle_id', 'subject', 'date', 'description', 'files'];

    public function vehicleData()
    {
        return $this->belongsTo("App\Model\VehicleData", "vehicle_id", "id")->withTrashed();
    }
    public function vehicle() {
        return $this->belongsTo("App\Model\VehicleModel", "vehicle_id", "id")->with('vehicleData')->withTrashed();
    }
}

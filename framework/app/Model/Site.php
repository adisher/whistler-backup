<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodeine\Metable\Metable;
use App\Model\SiteVehicleModel;


class Site extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "sites";
    protected $fillable = [
        'site_name',
        'site_details',
        'product_transfer',
        'custom_field',
        'deleted_at',
        'status',
    ];

    public function vehicles()
    {
        return $this->belongsToMany('App\Model\Site', 'site_vehicle', 'vehicle_id', 'site_id')->using(SiteVehicleModel::class);
    }
    public function workOrders()
    {
        return $this->hasMany('App\Model\WorkOrders', 'site_id');
    }
    public function shifts()
    {
        return $this->hasMany('App\Model\Shift', 'site_id');
    }
}
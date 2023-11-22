<?php

/*
@copyright
Fleet Manager v6.1
Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>
 */

namespace App\Model;

use App\Model\DriverVehicleModel;
use App\Model\SiteVehicleModel;
use App\Model\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodeine\Metable\Metable;

class VehicleModel extends Model
{
    use Metable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "vehicles";
    protected $metaTable = 'vehicles_meta'; //optional.
    protected $fillable = [
        'make_model_id',
        'color_name',
        'type',
        'year',
        'license_plate',
        'mileage',
        'int_mileage',
        'in_service',
        'user_id',
        'insurance_number',
        'documents',
        'vehicle_image',
        'exp_date',
        'reg_exp_date',
        'lic_exp_date',
        'group_id',
        'type_id',
        'fleet_no',
        'engine_no',
        'chasis_no',
        'tracker_no',
        'tracker_exp_date',
        'fitness_cert_no',
        'fitness_cert_exp_date',
        'certificates_images',
        'site',
        'fleet_condition',
        'insurance_issue_date',
        'insurance_exp_date',
        'driver',
        'expense_type',
        'expense_amount',
    ];

    protected function getMetaKeyName()
    {
        return 'vehicle_id'; // The parent foreign key
    }

    public function driver()
    {
        return $this->hasOne("App\Model\DriverVehicleModel", "vehicle_id", "id");
    }

    public function drivers()
    {
        return $this->belongsToMany(User::class, 'driver_vehicle', 'vehicle_id', 'driver_id')->using(DriverVehicleModel::class);
    }

    public function site()
    {
        return $this->hasOne("App\Model\SiteVehicleModel", "vehicle_id", "id");
    }

    public function sites()
    {
        return $this->belongsToMany('App\Model\Site', 'site_vehicle', 'vehicle_id', 'site_id')->using(SiteVehicleModel::class);
    }

    public function siteData()
    {
        return $this->belongsToMany('App\Model\Site', 'work_orders', 'vehicle_id', 'site_id');
    }
    public function income()
    {
        return $this->hasMany("App\Model\IncomeModel", "vehicle_id", "id")->withTrashed();
    }
    public function expense()
    {
        return $this->hasMany("App\Model\Expense", "vehicle_id", "id")->withTrashed();
    }

    public function insurance()
    {
        return $this->hasOne("App\Model\InsuranceModel", "vehicle_id", "id")->withTrashed();
    }

    public function acq()
    {
        return $this->hasMany("App\Model\AcquisitionModel", "vehicle_id", "id");
    }

    public function group()
    {
        return $this->hasOne("App\Model\VehicleGroupModel", "id", "group_id")->withTrashed();
    }

    public function reviews()
    {
        return $this->hasMany('App\Model\VehicleReviewModel', 'vehicle_id', 'id');
    }

    public function types()
    {
        return $this->hasOne("App\Model\VehicleTypeModel", "id", "type_id")->withTrashed();
    }
    public function vehicleData()
    {
        return $this->belongsTo('App\Model\VehicleData', 'make_model_id', 'id');
    }
    public function fuelCapacity()
    {
        return $this->hasOne('App\Model\VehicleData', 'id', 'make_model_id');
    }
    public function makeModel()
    {
        return $this->belongsTo('App\Model\VehicleData', 'make_model_id', 'id');
    }
    public function workOrders()
    {
        return $this->hasMany('App\Model\WorkOrders', 'vehicle_id');
    }

}

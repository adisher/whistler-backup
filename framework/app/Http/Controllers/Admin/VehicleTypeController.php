<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleTypeRequest;
use App\Model\FareSettings;
use App\Model\VehicleTypeModel;
use App\Model\VehicleMakeModel;
use App\Model\VehicleModelsModel;
use App\Model\VehicleModel;
use App\Model\VehicleData;
use DataTables;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:Vehicles add', ['only' => ['create']]);
        $this->middleware('permission:Vehicles edit', ['only' => ['edit']]);
        $this->middleware('permission:Vehicles delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:Vehicles list');
    }
    public function index()
    {
        $index['data'] = VehicleData::with('types')->get();
        return view('vehicle_types.index', $index);
    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $vehicle_types = VehicleData::with('types');

            return DataTables::eloquent($vehicle_types)
                ->addColumn('check', function ($vehicle) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $vehicle->id . '" class="checkbox" id="chk' . $vehicle->id . '" onclick=\'checkcheckbox();\'>';

                    return $tag;
                })
                ->addColumn('status', function ($vehicle) {
                    return ($vehicle->isenable) ? "Active" : "Not Active";
                })
                ->filterColumn('status', function ($query, $keyword) {
                    $query->whereRaw("IF(isenable = 1, 'Active', 'Not Active') like ?", ["%{$keyword}%"]);
                })
                ->addColumn('type', function ($vehicle) {
                    return ($vehicle->types) ? $vehicle->types->type_name : '';
                })
                ->addColumn('engine_type', function ($vehicle) {
                    return ($vehicle->engine_type) ? $vehicle->engine_type : '';
                })
                ->addColumn('horse_power', function ($vehicle) {
                    return ($vehicle->horse_power) ? $vehicle->horse_power : '';
                })
                ->addColumn('engine_capacity', function ($vehicle) {
                    return ($vehicle->engine_capacity) ? $vehicle->engine_capacity : '';
                })
                ->addColumn('fuel_capacity', function ($vehicle) {
                    return ($vehicle->fuel_capacity) ? $vehicle->fuel_capacity : '';
                })
                ->addColumn('oil_capacity', function ($vehicle) {
                    return ($vehicle->oil_capacity) ? $vehicle->oil_capacity : '';
                })
                ->addColumn('action', function ($vehicle) {
                    return view('vehicle_types.list-actions', ['row' => $vehicle]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'check'])
                ->make(true);
            //return datatables(User::all())->toJson();

        }
    }

    public function create()
    {
        $types = VehicleTypeModel::get();
        return view('vehicle_types.create', compact('types'));
    }

    public function store(Request $request)
    {
        if ($request->isenable == 1) {
            $enable = 1;
        } else {
            $enable = 0;
        }
        if($request->type_id == 'add_new'){
            $type = VehicleTypeModel::create([
                'type_name' => $request->new_type_name,
                'displayname' => $request->new_type_name,
                'isenable' => 1
            ]);
            $request->type_id = $type->id;
        }
            
        $new = VehicleData::create([
            'type_id' => $request->type_id,
            'make' => $request->make,
            'model' => $request->model,
            'engine_type' => $request->engine_type,
            'horse_power' => $request->horse_power,
            'engine_capacity' => $request->engine_capacity,
            'fuel_capacity' => $request->fuel_capacity,
            'oil_capacity' => $request->oil_capacity,
            'isenable' => $enable,
        ]);

        $key = $request->get('vehicletype');
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_base_fare', 'key_value' => '500', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_base_km', 'key_value' => '10', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_base_time', 'key_value' => '2', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_std_fare', 'key_value' => '20', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_weekend_base_fare', 'key_value' => '500', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_weekend_base_km', 'key_value' => '10', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_weekend_wait_time', 'key_value' => '2', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_weekend_std_fare', 'key_value' => '20', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_night_base_fare', 'key_value' => '500', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_night_base_km', 'key_value' => '10', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_night_wait_time', 'key_value' => '2', 'type_id' => $new->id]);
        FareSettings::create(['key_name' => strtolower(str_replace(" ", "", $key)) . '_night_std_fare', 'key_value' => '20', 'type_id' => $new->id]);

        return redirect()->route('vehicle-types.index');
    }

    public function edit($id)
    {
        $data['vehicle_data'] = VehicleData::find($id);
        $data['types'] = VehicleTypeModel::get();
        return view('vehicle_types.edit', $data);
    }
    // get record by type
    public function getByType($type_id) 
    {
        $vehicle_data = VehicleData::where('type_id', $type_id)->get();
        return response()->json($vehicle_data);
    }
    // check if fleet no exists
    public function checkFleetNo(Request $request)
    {
        $fleet_no = $request->get('fleet_no');

        $fleet = VehicleModel::where('fleet_no', $fleet_no)->first();

        if ($fleet) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
    public function update(Request $request)
    {
        if ($request->isenable == 1) {
            $enable = 1;
        } else {
            $enable = 0;
        }
        $data = VehicleData::find($request->get('id'));
        $data->update([
            'type_id' => $request->type_id,
            'make' => $request->make,
            'model' => $request->model,
            'engine_type' => $request->engine_type,
            'horse_power' => $request->horse_power,
            'engine_capacity' => $request->engine_capacity,
            'fuel_capacity' => $request->fuel_capacity,
            'oil_capacity' => $request->oil_capacity,
            'isenable' => $enable,
        ]);

        $settings = FareSettings::where('type_id', $request->get('id'))->get();
        // dd($settings);
        foreach ($settings as $key) {
            // echo "old  " . $key->key_name . "  === ";
            // echo "new " . str_replace($request->get('old_type'), strtolower(str_replace(' ', '', $request->get('type'))), $key->key_name) . "<br>";

            // update key_name in fare settings
            $key->key_name = str_replace($request->get('old_type'), strtolower(str_replace(' ', '', $request->get('vehicletype'))), $key->key_name);
            $key->save();
        }

        return redirect()->route('vehicle-types.index');
    }

    public function destroy(Request $request)
    {
        VehicleData::find($request->get('id'))->delete();
        return redirect()->route('vehicle-types.index');
    }

    public function bulk_delete(Request $request)
    {
        VehicleData::whereIn('id', $request->ids)->delete();
        return back();
    }
}

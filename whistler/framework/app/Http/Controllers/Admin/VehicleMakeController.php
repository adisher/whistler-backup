<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleMakeRequest;
use App\Model\FareSettings;
use App\Model\VehicleMakeModel;
use DataTables;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:VehicleType add', ['only' => ['create']]);
        $this->middleware('permission:VehicleType edit', ['only' => ['edit']]);
        $this->middleware('permission:VehicleType delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:VehicleType list');
    }
    public function index()
    {
        $index['data'] = VehicleMakeModel::get();
        return view('vehicle_make.index', $index);
    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $vehicle_make = VehicleMakeModel::query();

            return DataTables::eloquent($vehicle_make)
                ->addColumn('check', function ($vehicle) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $vehicle->id . '" class="checkbox" id="chk' . $vehicle->id . '" onclick=\'checkcheckbox();\'>';

                    return $tag;
                })
                ->addColumn('isenable', function ($vehicle) {
                    return ($vehicle->isenable) ? "YES" : "NO";
                })
                ->filterColumn('isenable', function ($query, $keyword) {
                    $query->whereRaw("IF(isenable = 1, 'YES', 'NO') like ?", ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($vehicle) {
                    return view('vehicle_make.list-actions', ['row' => $vehicle]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'check'])
                ->make(true);
            //return datatables(User::all())->toJson();

        }
    }

    public function create()
    {
        return view('vehicle_make.create');
    }

    public function store(VehicleMakeRequest $request)
    {
        if ($request->isenable == 1) {
            $enable = 1;
        } else {
            $enable = 0;
        }
        $new = VehicleMakeModel::create([
            'make' => $request->vehiclemake,
            'isenable' => $enable,
        ]);

        $key = $request->get('vehiclemake');
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

        return redirect()->route('vehicle-make.index');
    }

    public function edit($id)
    {
        $data['vehicle_make'] = VehicleMakeModel::find($id);
        return view('vehicle_make.edit', $data);
    }

    public function update(VehicleMakeRequest $request)
    {
        if ($request->isenable == 1) {
            $enable = 1;
        } else {
            $enable = 0;
        }
        $data = VehicleMakeModel::find($request->get('id'));
        $data->update([
            'make' => $request->vehiclemake,
            'isenable' => $enable,
        ]);

        return redirect()->route('vehicle-make.index');
    }

    public function destroy(Request $request)
    {
        VehicleMakeModel::find($request->get('id'))->delete();
        return redirect()->route('vehicle-make.index');
    }

    public function bulk_delete(Request $request)
    {
        VehicleMakeModel::whereIn('id', $request->ids)->delete();
        return back();
    }
}

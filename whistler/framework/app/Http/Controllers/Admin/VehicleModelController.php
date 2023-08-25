<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleModelRequest;
use App\Model\FareSettings;
use App\Model\VehicleModelsModel;
use DataTables;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
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
        $index['data'] = VehicleModelsModel::get();
        return view('vehicle_model.index', $index);
    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $vehicle_model = VehicleModelsModel::query();

            return DataTables::eloquent($vehicle_model)
                ->addColumn('check', function ($vehicle) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $vehicle->id . '" class="checkbox" id="chk' . $vehicle->id . '" onclick=\'checkcheckbox();\'>';

                    return $tag;
                })
                ->addColumn('action', function ($vehicle) {
                    return view('vehicle_model.list-actions', ['row' => $vehicle]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'check'])
                ->make(true);
            //return datatables(User::all())->toJson();

        }
    }

    public function create()
    {
        return view('vehicle_model.create');
    }

    public function store(VehicleModelRequest $request)
    {
        $new = VehicleModelsModel::create([
            'name' => $request->vehiclemodel,
        ]);

        return redirect()->route('vehicle-model.index');
    }

    public function edit($id)
    {
        $data['vehicle_model'] = VehicleModelsModel::find($id);
        return view('vehicle_model.edit', $data);
    }

    public function update(VehicleModelRequest $request)
    {
        $data = VehicleModelsModel::find($request->get('id'));
        $data->update([
            'name' => $request->vehiclemodel,
        ]);

        return redirect()->route('vehicle-model.index');
    }

    public function destroy(Request $request)
    {
        VehicleModelsModel::find($request->get('id'))->delete();
        return redirect()->route('vehicle-model.index');
    }

    public function bulk_delete(Request $request)
    {
        VehicleModelsModel::whereIn('id', $request->ids)->delete();
        return back();
    }
}

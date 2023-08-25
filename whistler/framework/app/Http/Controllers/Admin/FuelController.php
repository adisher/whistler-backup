<?php

/*
@copyright
Fleet Manager v6.1
Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FuelRequest;
use App\Model\DriverLogsModel;
use App\Model\Expense;
use App\Model\FuelModel;
use App\Model\FuelAllocationModel;
use App\Model\VehicleModel;
use App\Model\Vendor;
use App\Model\Currency;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FuelController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:Fuel add', ['only' => ['create']]);
        $this->middleware('permission:Fuel edit', ['only' => ['edit']]);
        $this->middleware('permission:Fuel delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:Fuel list');
    }

    public function index()
    {
        if (Auth::user()->user_type == "S" || Auth::user()->user_type != "D") {
            if (Auth::user()->group_id == null) {
                $vehicle_ids = VehicleModel::pluck('id')->toArray();
            } else {
                $vehicle_ids = VehicleModel::where('group_id', Auth::user()->group_id)->pluck('id')->toArray();
            }
        }
        if (Auth::user()->user_type == "D") {
            $vehicle = DriverLogsModel::where('driver_id',Auth::user()->id)->get()->toArray();
            $vehicle_ids = VehicleModel::where('id', $vehicle[0]['vehicle_id'])->pluck('id')->toArray();
            $vehicle_ids = auth()->user()->vehicles()->pluck('vehicles.id')->toArray();
        }

        // $data['allocation'] = FuelAllocationModel::with('vehicle_data', 'vehicle_data.types')->orderBy('id', 'desc')->whereIn('vehicle_id', $vehicle_ids)->get();
        $data['allocation'] = FuelAllocationModel::with(['vehicle_data'])->get();
        // dd($data['allocation']);
        // $data['data'] = FuelModel::orderBy('id', 'desc')->get();
        return view('fuel.index', $data);
    }
    public function fuel_table()
    {
        if (Auth::user()->user_type == "S" || Auth::user()->user_type != "D") {
            if (Auth::user()->group_id == null) {
                $vehicle_ids = VehicleModel::pluck('id')->toArray();
            } else {
                $vehicle_ids = VehicleModel::where('group_id', Auth::user()->group_id)->pluck('id')->toArray();
            }
        }
        if (Auth::user()->user_type == "D") {
            $vehicle = DriverLogsModel::where('driver_id', Auth::user()->id)->get()->toArray();
            $vehicle_ids = VehicleModel::where('id', $vehicle[0]['vehicle_id'])->pluck('id')->toArray();
            $vehicle_ids = auth()->user()->vehicles()->pluck('vehicles.id')->toArray();
        }

        $data['allocation'] = FuelAllocationModel::with('vehicle_data')->orderBy('id', 'desc')->whereIn('vehicle_id', $vehicle_ids)->get();
       
        $data['data'] = FuelModel::with('vendor')->orderBy('id', 'desc')->get();
        $data['currency'] = Currency::find(2);
        return view('fuel.fueltable', $data);
    }
    public function create()
    {
        if (Auth::user()->user_type == "S" || Auth::user()->user_type != "D") {
            if (Auth::user()->group_id == null) {
                $data['vehicles'] = VehicleModel::with('vehicleData')->get();
            } else {
                $data['vehicles'] = VehicleModel::with('vehicleData')->get();
            }
        }

        if (Auth::user()->user_type == "D") {
            // $vehicle = DriverLogsModel::where('driver_id',Auth::user()->id)->get()->toArray();
            // $data['vehicles'] = VehicleModel::where('id', $vehicle[0]['vehicle_id'])->whereIn_service("1")->get();
            $data['vehicles'] = auth()->user()->vehicles()->whereIn_service("1")->get();
        }
        $fuel_allocation = FuelAllocationModel::sum('consumption');
        $fuel_stock = FuelModel::sum('qty');
        $data['stock'] = $fuel_stock - $fuel_allocation;
        $data['vendors'] = Vendor::where('type', 'fuel')->get();
        return view('fuel.create', $data);
    }
    public function add_fuel_form()
    {
        if (Auth::user()->user_type == "S" || Auth::user()->user_type != "D") {
            if (Auth::user()->group_id == null) {
                $data['vehicles'] = VehicleModel::whereIn_service("1")->get();
            } else {
                $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->whereIn_service("1")->get();
            }
        }

        if (Auth::user()->user_type == "D") {
            // $vehicle = DriverLogsModel::where('driver_id',Auth::user()->id)->get()->toArray();
            // $data['vehicles'] = VehicleModel::where('id', $vehicle[0]['vehicle_id'])->whereIn_service("1")->get();
            $data['vehicles'] = auth()->user()->vehicles()->whereIn_service("1")->get();
        }
        $data['vendors'] = Vendor::where('type', 'fuel')->get();
        $data['currency'] = Currency::find(2);
        return view('fuel.addfuel', $data);
    }

    public function get_fuel_capacity(Request $request)
    {
        $makeModelId = $request->get('make_model_id');
        $vehicleId = $request->get('vehicle_id');
        
        $vehicle = VehicleModel::findOrFail($vehicleId);
        if ($vehicle->make_model_id) {
            // Assuming the relationship method between VehicleModel and VehicleData is called vehicleData
            $fuel_capacity = $vehicle->vehicleData->fuel_capacity;
        } else {
            // handle the case where make_model_id is not set
            $fuel_capacity = null; // or any default value
        }

        return response()->json(['fuel_capacity' => $fuel_capacity]);
    }
    public function add_fuel(FuelRequest $request)
    {
        // dd($request->all());

        $fuel = new FuelModel();
        // $fuel->vehicle_id = $request->get('vehicle_id');
        $fuel->user_id = $request->get('user_id');

        $fuel->start_meter = "0";
        $fuel->end_meter = "0";
        // $fuel->consumption = "0";
        // $fuel->reference = $request->get('reference');
        // $fuel->province = $request->get('province');
        $fuel->note = $request->get('note');
        $fuel->qty = $request->get('qty');
        $fuel->fuel_from = $request->get('fuel_from');
        $fuel->vendor_name = $request->get('vendor_name');
        $fuel->cost_per_unit = $request->get('cost_per_unit');
        $fuel->date = $request->get('date');
        // $fuel->complete = $request->get("complete");

        $file = $request->file('image');
        if ($file && $file->isValid()) {
            $destinationPath = './uploads'; // upload path
            $extension = $file->getClientOriginalExtension();

            $fileName1 = Str::uuid() . '.' . $extension;

            $file->move($destinationPath, $fileName1);

            $fuel->image = $fileName1;
        }

        $fuel->save();

        $expense = new Expense();
        $expense->vehicle_id = "1";
        $expense->user_id = $request->get('user_id');
        $expense->expense_type = '8';
        $expense->comment = $request->get('note');
        $expense->date = $request->get('date');
        $amount = $request->get('qty') * $request->get('cost_per_unit');
        $expense->amount = $amount;
        $expense->exp_id = $fuel->id;
        $expense->save();
        VehicleModel::where('id', $request->vehicle_id)->update(['mileage' => $request->start_meter]);
        return redirect('admin/fuel/fuel-details');
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $fuel = new FuelAllocationModel();
        $fuel->vehicle_id = $request->get('vehicle_id');
        $fuel->user_id = $request->get('user_id');
        
        if($request->input('fleet_type_id') == 1)
        {
            $fuel->meter = $request->get('meter_reading');
            $fuel->time = $request->get('hours');
            $fuel->consumption = 0;
            $fuel->consumption = $con = $fuel->meter;
            $fuel->time = '0:00';
        }
        else if($request->input('fleet_type_id') == 2)
        {
            $fuel->qty = $request->get('quantity');
            $fuel->time = $request->get('hours');
            $fuel->meter = 0;
        }
        // $fuel->qty = $request->get('qty');
        // if ($request->get('qty') == 0) {
        //             $fuel->consumption = $con = 0;
        //         } else {
        //             $fuel->consumption = $con = ($end - $fuel->start_meter) / $fuel->qty;
        //         }
        // $fuel_allocation = FuelAllocationModel::sum('consumption');
        // $fuel_stock = FuelModel::sum('qty');

        // $fuel->fuel_from = $request->get('fuel_from');
        // $fuel->vendor_name = $request->get('vendor_name');
        // $fuel->cost_per_unit = $request->get('cost_per_unit');
        $fuel->note = $request->get('note');
        $fuel->date = $request->get('date');
        $fuel->complete = $request->get("complete");

        $file = $request->file('image');
        if ($file && $file->isValid()) {
            $destinationPath = './uploads'; // upload path
            $extension = $file->getClientOriginalExtension();

            $fileName1 = Str::uuid() . '.' . $extension;

            $file->move($destinationPath, $fileName1);

            $fuel->image = $fileName1;
        }

        $fuel->save();

        // $expense = new Expense();
        // $expense->vehicle_id = $request->get('vehicle_id');
        // $expense->user_id = $request->get('user_id');
        // $expense->expense_type = '8';
        // $expense->comment = $request->get('note');
        // $expense->date = $request->get('date');
        // $amount = $request->get('qty') * $request->get('cost_per_unit');
        // $expense->amount = $amount;
        // $expense->exp_id = $fuel->id;
        // $expense->save();
        // VehicleModel::where('id', $request->vehicle_id)->update(['mileage' => $request->start_meter]);
        return redirect('admin/fuel');
    }

    public function edit_fuel(Request $request, $id)
    {
        $fuel_allocation = FuelAllocationModel::whereId($id)->get()->first();
        $fuel = FuelModel::whereId($id)->orderBy('id', 'desc')->get()->first();
        $fuelAllocation = FuelAllocationModel::with('vehicle_data')
        ->where('vehicle_id', $request->get('fleet_id'))
        ->first();

        $vehicle_id = $fuel_allocation->vehicle_id;
        $vendors = Vendor::where('type', 'fuel')->get();
        $currency = Currency::find(2);
  
        return view('fuel.edit-fuel', compact('currency', 'fuel', 'vehicle_id', 'vendors'));


    }
    public function edit(Request $request, $id)
    {
        $fuel_allocation = FuelAllocationModel::whereId($id)->get()->first();
        // dd($fuel_allocation);
        $fuel = FuelModel::whereId($id)->orderBy('id', 'desc')->get()->first();
        // dd($data['fuel']);
        $fuelAllocation = FuelAllocationModel::with(['vehicle_data'])
        ->where('vehicle_id', $request->get('fleet_id'))
        ->first();

        if ($fuelAllocation) {
            $type_id = $fuelAllocation->vehicle_data->type_id;
            $allocation = '';
        } else {
            dd('Fuel allocation not found for the given vehicle ID.');
        }


        $vehicle_id = $fuel_allocation->vehicle_id;
        $vendors = Vendor::where('type', 'fuel')->get();

        return view('fuel.edit', compact('fuel', 'vehicle_id', 'vendors', 'fuel_allocation', 'type_id'));

        if ($fuelAllocation) {
            return view('fuel.edit', compact('fuel_allocation', 'allocation', 'vehicle_id', 'type_id', 'vendors'));
        } elseif ($fuel) {
        }


    }

    public function update_fuel(Request $request)
    {
        $fuel = FuelModel::find($request->get("id"));
        // $old = $fuel->where('end_meter', $fuel->start_meter)->first();
        // if ($old != null) {
        //     $old->end_meter = $request->get('start_meter');
        //     $old->consumption = ($old->end_meter - $old->start_meter) / $old->qty;
        //     $old->save();
        // }

        $fuel->start_meter = $request->get('start_meter');
        $fuel->note = $request->get('note');
        $fuel->qty = $request->get('qty');
        $fuel->fuel_from = $request->get('fuel_from');
        $fuel->vendor_name = $request->get('vendor_name');
        $fuel->cost_per_unit = $request->get('cost_per_unit');
        $fuel->date = $request->get('date');
        // $fuel->complete = $request->get("complete");
        // if ($fuel->end_meter != 0) {
        //     $fuel->consumption = ($fuel->end_meter - $request->get('start_meter')) / $request->get('qty');
        // }

        $file = $request->file('image');
        if ($file && $file->isValid()) {
            $destinationPath = './uploads'; // upload path
            $extension = $file->getClientOriginalExtension();

            $fileName1 = Str::uuid() . '.' . $extension;

            $file->move($destinationPath, $fileName1);

            $fuel->image = $fileName1;
        }

        $fuel->save();
        $exp = Expense::where('exp_id', $request->get('id'))->where('expense_type', 8)->first();
        if ($exp != null) {
            $exp->amount = $request->get('qty') * $request->get('cost_per_unit');
            $exp->save();
        }
        // VehicleModel::where('id', $request->vehicle_id)->update(['mileage' => $request->start_meter]);
        return redirect()->route('fuel.fuel_details');

    }
    public function update(Request $request)
    {
        $fuel = FuelAllocationModel::find($request->get("id"));
        // $form_data = $request->all();
        $old = FuelAllocationModel::where('vehicle_id', $fuel->vehicle_id)->first();
        if ($old != null && $old->qty != 0) {
            // dd($request->all());
            $old->meter = $request->get('meter_reading');
            $old->consumption = $old->meter;
            $old->save();
        }

        // if ($request->input('fleet_type_id') == 1) {
        //     dd('meter');
        //     $fuel->start_meter = $request->get('start_meter');
        //     $fuel->end_meter = $request->get('end_meter');
        //     $fuel->qty = '';
        // } else if ($request->input('fleet_type_id') == 2) {
        //     dd('qty');
        //     $fuel->qty = $request->get('quantity');
        //     $fuel->start_meter = '';
        //     $fuel->end_meter = '';
        // }

        $fuel->meter = $request->get('meter_reading');
        $fuel->note = $request->get('note');
        $fuel->qty = $request->get('quantity');
        $fuel->time = $request->get('hours');
        $fuel->date = $request->get('date');
        $fuel->complete = $request->get("complete");
        if ($fuel->meter != 0 && $fuel->qty != 0) {
            $fuel->consumption = $fuel->meter;
        } else {
            $fuel->consumption = 0;
        }

        $file = $request->file('image');
        if ($file && $file->isValid()) {
            $destinationPath = './uploads'; // upload path
            $extension = $file->getClientOriginalExtension();

            $fileName1 = Str::uuid() . '.' . $extension;

            $file->move($destinationPath, $fileName1);

            $fuel->image = $fileName1;
        }

        $fuel->save();
        $exp = Expense::where('exp_id', $request->get('id'))->where('expense_type', 8)->first();
        if ($exp != null) {
            $exp->amount = $request->get('quantity') * $request->get('cost_per_unit');
            $exp->save();
        }
        VehicleModel::where('id', $request->vehicle_id)->update(['mileage' => $request->start_meter]);
        return redirect()->route('fuel.index');

    }

    public function destroy(Request $request)
    {
        $fuel = FuelAllocationModel::find($request->get('id'));

        if (!is_null($fuel->image) && file_exists('uploads/' . $fuel->image)) {
            unlink('uploads/' . $fuel->image);
        }

        $fuel->delete();

        Expense::where('exp_id', $request->get('id'))->where('expense_type', 8)->delete();
        return redirect()->route('fuel.index');
    }

    public function destroy_fuel(Request $request)
    {
        $fuel = FuelModel::find($request->get('id'));
        $fuel->delete();

        Expense::where('exp_id', $request->get('id'))->where('expense_type', 8)->delete();
        return redirect()->route('fuel.fuel_details');
    }

    public function bulk_delete(Request $request)
    {
        $fuels = FuelModel::whereIn('id', $request->ids)->get();
        foreach ($fuels as $fuel) {
            if (!is_null($fuel->image) && file_exists('uploads/' . $fuel->image)) {
                unlink('uploads/' . $fuel->image);
            }
            $fuel->delete();
        }

        Expense::whereIn('exp_id', $request->ids)->where('expense_type', 8)->delete();
        return back();
    }
}
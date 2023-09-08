<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PartsModel;
use App\Model\PreventiveMaintenanceLogs;
use App\Model\PreventiveMaintenanceModel;
use App\Model\ServiceItemsModel;
use App\Model\ServiceReminderModel;
use App\Model\User;
use App\Model\VehicleModel;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreventiveMaintenanceController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:ServiceReminders add', ['only' => ['create']]);
        $this->middleware('permission:ServiceReminders edit', ['only' => ['edit']]);
        $this->middleware('permission:ServiceReminders delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:ServiceReminders list');
    }

    public function close_preventive_maintenance(Request $request)
    {
        // dd($request->all());
        $row_id = $request->input('row_id');
        $service_item_id = $request->get('service_item_id');
        $last_performed = $request->input('last_performed');
        $next_planned = $request->input('next_planned');
        $end_meter = $request->input('end_meter');
        $deviation = $request->input('deviation');
        $qty = $request->input('qty');
        $parts_id = $request->input('parts_id');

        $items_price = PartsModel::find($parts_id)->unit_cost * $qty;

        $meter_interval = ServiceItemsModel::find($service_item_id)->meter_interval;

        // Calculate the next planned meter reading based on service_item's interval
        $next_planned = $end_meter + $meter_interval;

        // Here you would update your database record
        $record = PreventiveMaintenanceModel::find($row_id);
        $record->last_performed = $end_meter;
        $record->deviation = $deviation;
        $record->next_planned = $next_planned;
        $record->price += $items_price;
        $record->quantity += $qty;
        $record->status += 1;

        $record->save();

        $preventiveLog = new PreventiveMaintenanceLogs();

        foreach ($record->getAttributes() as $key => $value) {
            if ($key !== 'id') { // Skip the id field
                $preventiveLog->$key = $value;
            }
        }
        $preventiveLog->maintenance_id = $record->id; // Set the maintenance_id to the original id

        $preventiveLog->save();

        // After updating the PreventiveMaintenanceModel
        $serviceReminder = ServiceReminderModel::where('maintenance_id', $row_id)->first();
        $serviceReminder->last_date = now(); 
        $serviceReminder->last_meter = $end_meter;
        $serviceReminder->save();

        return response()->json(['status' => 'success']);
    }

    public function index()
    {
        // $vehicle_ids = VehicleData::pluck('id')->toArray();
        // $vehicle_ids = VehicleData::where('group_id', Auth::user()->group_id)->pluck('id')->toArray();
        $data['preventive_maintenance'] = PreventiveMaintenanceModel::with('vehicle', 'services', 'parts')->get();
        return view('preventive_maintenance.index', $data);
    }

    public function logs()
    {
        $data['preventive_maintenance'] = PreventiveMaintenanceLogs::with('vehicle', 'services', 'parts')->get();
        return view('preventive_maintenance.logs', $data);
    }

    public function create()
    {
        $data['services'] = ServiceItemsModel::get();
        $data['vehicles'] = VehicleModel::with('vehicleData')->get();
        $data['parts'] = PartsModel::with(['vendor', 'category'])->orderBy('id', 'desc')->get();
        $data['recipients'] = DB::table('recipients')->get();

        return view('preventive_maintenance.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->recipients);

        $vehicle_id = $request->vehicle_id;
        $quantity = $request->quantity;

        // Fetch the current meter reading from the VehicleModel
        $current_meter_reading = VehicleModel::find($vehicle_id)->int_mileage;

        foreach ($request->get('chk') as $item) {
            // Fetch data from request or other sources for each item
            $service_item_id = $item;

            // Calculate the planned_meter_reading based on service_item's interval
            $service_item = ServiceItemsModel::find($item);
            $planned_meter_reading = $current_meter_reading + $service_item->meter_interval;

            // Create new preventive maintenance record
            $preventive = new PreventiveMaintenanceModel();
            $preventive->service_item_id = $service_item_id;
            $preventive->parts_id = $request->parts_id;
            $preventive->vehicle_id = $vehicle_id;
            $preventive->last_performed = $current_meter_reading;
            $preventive->next_planned = $planned_meter_reading;
            $preventive->date = $request->date;
            $preventive->price = $request->price;
            $preventive->quantity = $quantity;
            $preventive->status = '1';
            $preventive->user_id = Auth::user()->id;
            $preventive->email_to = implode(',', $request->recipients);
            $preventive->save();

            // replicate the preventive maintenance record for each entry
            $preventiveLog = new PreventiveMaintenanceLogs();
            foreach ($preventive->getAttributes() as $key => $value) {
                if ($key !== 'id') { // Skip the id field
                    $preventiveLog->$key = $value;
                }
            }
            $preventiveLog->maintenance_id = $preventive->id;

            $preventiveLog->save();

            // After saving the PreventiveMaintenanceModel
            $serviceReminder = new ServiceReminderModel();
            $serviceReminder->maintenance_id = $preventive->id;
            $serviceReminder->last_date = now();
            $serviceReminder->last_meter = $current_meter_reading;
            $serviceReminder->save();


        }

        return redirect()->route('preventive-maintenance.index');
    }

    // public function dummy(){
    //     $history = PreventiveMaintenanceModel::whereVehicleId($request->get('vehicle_id'))->where('service_id', $item)->orderBy('id', 'desc')->first();
    //         if ($history == null) {
    //             $last_date = "N/D";
    //             $last_meter = "0";
    //         } else {
    //             $interval = substr($history->services->overdue_unit, 0, -3);
    //             $int = $history->services->overdue_time . $interval;
    //             $date = date('Y-m-d', strtotime($int, strtotime(date('Y-m-d'))));
    //             $last_date = $date;
    //             if ($history->last_meter == 0) {
    //                 $total = $history->vehicle->int_mileage;
    //             } else {
    //                 $total = $history->last_meter;
    //             }
    //             $last_meter = $total + $history->services->overdue_meter;
    //         }
    //         $reminder = new PreventiveMaintenanceModel();
    //         $reminder->vehicle_id = $request->get('vehicle_id');
    //         $reminder->service_id = $item;
    //         $reminder->last_date = $request->start_date;
    //         $reminder->last_meter = $last_meter;
    //         $reminder->user_id = Auth::user()->id;
    //         $reminder->save();

    //         $preventive_maintenance = PreventiveMaintenanceModel::find($reminder->id);
    // }

    public function destroy(Request $request)
    {
        PreventiveMaintenanceModel::find($request->get('id'))->delete();
        return redirect()->route('preventive-maintenance.index');
    }

    public function bulk_delete(Request $request)
    {
        PreventiveMaintenanceModel::whereIn('id', $request->ids)->delete();
        return back();
    }

}

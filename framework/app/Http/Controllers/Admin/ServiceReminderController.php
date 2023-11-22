<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceReminder;
use App\Model\ServiceItemsModel;
use App\Model\ServiceReminderModel;
use App\Model\PreventiveMaintenanceModel;
use App\Model\User;
use App\Model\VehicleModel;
use App\Model\PartsModel;
use App\Model\VehicleData;
use Auth;
use Illuminate\Http\Request;

class ServiceReminderController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:ServiceReminders add', ['only' => ['create']]);
        $this->middleware('permission:ServiceReminders edit', ['only' => ['edit']]);
        $this->middleware('permission:ServiceReminders delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:ServiceReminders list');
    }

    public function index()
    {
            // $vehicle_ids = VehicleData::pluck('id')->toArray();
            // $vehicle_ids = VehicleData::where('group_id', Auth::user()->group_id)->pluck('id')->toArray();
        $data['service_reminder'] = ServiceReminderModel::with('services', 'preventive_maintenance')->get();
        // dd($data['service_reminder']);
        return view('service_reminder.index', $data);
    }

    public function create()
    {
        $data['services'] = ServiceItemsModel::get();
        $data['vehicles'] = VehicleModel::with('vehicleData')->get();
        $data['parts'] = PartsModel::with(['vendor', 'category'])->orderBy('id', 'desc')->get();

        return view('service_reminder.create', $data);
    }

    public function store(ServiceReminder $request)
    {
        dd($request->all());
        $users = User::where('user_type', 'S')->get();
       
        foreach ($request->get('chk') as $item) {

            $history = ServiceReminderModel::whereVehicleId($request->get('vehicle_id'))->where('service_id', $item)->orderBy('id', 'desc')->first();
            if ($history == null) {
                $last_date = "N/D";
                $last_meter = "0";
            } else {
                $interval = substr($history->services->overdue_unit, 0, -3);
                $int = $history->services->overdue_time . $interval;
                $date = date('Y-m-d', strtotime($int, strtotime(date('Y-m-d'))));
                $last_date = $date;
                if ($history->last_meter == 0) {
                    $total = $history->vehicle->int_mileage;
                } else {
                    $total = $history->last_meter;
                }
                $last_meter = $total + $history->services->overdue_meter;
            }
            $reminder = new ServiceReminderModel();
            $reminder->vehicle_id = $request->get('vehicle_id');
            $reminder->service_id = $item;
            $reminder->last_date = $request->start_date;
            $reminder->last_meter = $last_meter;
            $reminder->user_id = Auth::user()->id;
            $reminder->save();

            $preventive_maintenance = PreventiveMaintenanceModel::find($reminder->id);


        }

        return redirect()->route('service-reminder.index');
    }

    public function destroy(Request $request)
    {
        ServiceReminderModel::find($request->get('id'))->delete();
        return redirect()->route('service-reminder.index');
    }

    public function bulk_delete(Request $request)
    {
        ServiceReminderModel::whereIn('id', $request->ids)->delete();
        return back();
    }

}

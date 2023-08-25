<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DriverLogsModel;
use App\Model\DriverVehicleModel;
use App\Model\Hyvikk;
use App\Model\PartsModel;
use App\Model\PartsUsedModel;
use App\Model\Site;
use App\Model\User;
use App\Model\VehicleModel;
use App\Model\WorkOrderLogs;
use App\Model\WorkOrders;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class WorkOrdersController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:WorkOrders add', ['only' => ['create']]);
        $this->middleware('permission:WorkOrders edit', ['only' => ['edit']]);
        $this->middleware('permission:WorkOrders delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:WorkOrders list');
    }

    public function logs()
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $vehicle_ids = VehicleModel::pluck('id')->toArray();
        } else {
            $vehicle_ids = VehicleModel::where('group_id', Auth::user()->group_id)->pluck('id')->toArray();
        }
        $index['data'] = WorkOrderLogs::with(['sites'])->select('work_order_logs.*')->orderBy('id', 'desc')->get();
        // dd($index['data']);
        return view('work_orders.logs', $index);
    }

    public function assigned_driver(Request $request, $id)
    {
        $existingDriver = DriverVehicleModel::where('driver_id', $id)->first();
        if ($existingDriver) {
            return response()->json(['error' => 'This driver is already assigned to another vehicle.']);
        }
        return response()->json(['success' => 'Driver is available.']);
    }

    public function index()
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $vehicle_ids = VehicleModel::pluck('id')->toArray();
        } else {
            $vehicle_ids = VehicleModel::where('group_id', Auth::user()->group_id)->pluck('id')->toArray();
        }
        $index['data'] = WorkOrders::with(['sites', 'assigned_driver'])->select('work_orders.*')->orderBy('id', 'desc')->get();
        // dd($index['data']);
        return view('work_orders.index', $index);
    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            // $vehicle_ids = VehicleModel::with('vehicleData')->get();

            $work_orders = WorkOrders::with(['vehicleData', 'vehicle'])->select('work_orders.*')->orderBy('id', 'desc');
            // ->leftJoin('vehicle', 'work_orders.vehicle_id', '=', 'vehicles.id');

            $date_format_setting = (Hyvikk::get('date_format')) ? Hyvikk::get('date_format') : 'd-m-Y';
            return DataTables::eloquent($work_orders)
                ->addColumn('check', function ($work_order) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $work_order->id . '" class="checkbox" id="chk' . $work_order->id . '" onclick=\'checkcheckbox();\'>';
                    return $tag;
                })

                ->addColumn('vehicle_image', function ($work_order) {
                    $src = ($work_order->vehicle_id != null) ? asset('uploads/' . $work_order->vehicle->vehicle_image) : asset('assets/images/vehicle.jpeg');

                    return '<img src="' . $src . '" height="70px" width="70px">';
                })
                ->addColumn('vehicle', function ($work_order) {
                    return $work_order->vehicle->year . '<br/>' . $work_order->vehicleData->make . '-' . $work_order->vehicleData->model . '<br/>' .
                    '<b>' . __('fleet.plate') . ': </b>' . $work_order->vehicle->license_plate;

                })
                ->editColumn('status', function ($work_order) {
                    $tag = '';
                    switch ($work_order->status) {
                        case 'Completed':
                            $tag = '<span class="text-success">' . $work_order->status . '</span>';
                            break;
                        case 'Pending':
                            $tag = '<span class="text-warning">' . $work_order->status . '</span>';
                            break;

                        default:
                            $tag = $work_order->status;
                            break;
                    }
                    return $tag;
                })
                ->addColumn('action', function ($work_order) {
                    return view('work_orders.list-actions', ['row' => $work_order]);
                })
                ->rawColumns(['vehicle_image', 'vehicle', 'action', 'check', 'status'])
                ->addIndexColumn()
                ->make(true);
            //return datatables(User::all())->toJson();

        }
    }

    public function create()
    {
        $data['vehicles'] = VehicleModel::with('vehicleData')->get();

        $data['sites'] = Site::get();

        $data['drivers'] = User::where('user_type', 'D')->get();
        $assigned_drivers_query = DriverVehicleModel::with('vehicle')->get();
        $data['open_shift'] = DriverVehicleModel::pluck('vehicle_id')->toArray();

        $assigned_drivers = [];

        foreach ($assigned_drivers_query as $assigned_driver) {
            $assigned_drivers[$assigned_driver->driver_id] = [
                'vehicle_id' => $assigned_driver->vehicle_id,
                'vehicle_data' => $assigned_driver->vehicle, // You can access the vehicle data here
            ];
        }

        $data['assigned_driver'] = $assigned_drivers;

        // $data['vendors'] = Vendor::get();
        // $data['mechanic'] = Mechanic::get();
        // $data['parts'] = PartsModel::where('stock', '>', 0)->where('availability', 1)->get();
        return view('work_orders.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $vehicle_id = $request->get('vehicle_id');
        $driver_id = $request->get('driver_id');
        // dd($vehicle_id, $driver_id);

        // Check if the driver is already assigned to another vehicle
        $existingDriver = DriverVehicleModel::where('driver_id', $driver_id)->first();
        // dd($existingDriver);

        if ($existingDriver) {
            return redirect()->back()->with('error', 'This driver is already assigned to another vehicle.');
        }

        $order = new WorkOrders();
        $order->site_id = $request->get('site_id');
        $order->vehicle_id = $request->get('vehicle_id');
        $order->driver_id = $request->get('driver_id');
        $order->shift_id = $request->get('shift_id');
        $order->status = $request->get('status');
        $order->description = $request->get('description');
        $order->date = $request->get('date');
        $order->start_meter = $request->get('start_meter');
        $order->work_hours = $request->get('work_hours') ?? '0';
        $order->price = $request->get('price');
        $order->user_id = Auth::user()->id;
        $order->save();

        $log = new WorkOrderLogs();
        $log->date = $request->get('date');
        $log->price = $request->get('price');
        $log->work_hours = $request->get('work_hours') ?? '0';
        $log->user_id = Auth::user()->id;
        $log->site_id = $request->get('site_id');
        $log->vehicle_id = $request->get('vehicle_id');
        $log->start_meter = $request->get('start_meter');
        $log->driver_id = $request->get('driver_id');
        $log->shift_id = $request->get('shift_id');
        $log->status = $request->get('status');
        $log->description = $request->get('description');
        $log->save();

        DriverVehicleModel::updateOrCreate(['vehicle_id' => $request->get('vehicle_id')], ['vehicle_id' => $request->get('vehicle_id'), 'driver_id' => $request->get('driver_id')]);
        DriverLogsModel::create(['driver_id' => $request->get('driver_id'), 'vehicle_id' => $request->get('vehicle_id'), 'date' => date('Y-m-d H:i:s')]);

        // $parts = $request->parts;

        // if ($parts != null) {
        //     foreach ($parts as $part_id => $qty) {

        //         $update_part = PartsModel::find($part_id);
        //         PartsUsedModel::create(['work_id' => $order->id, 'part_id' => $part_id, 'qty' => $qty, 'price' => $update_part->unit_cost, 'total' => $qty * $update_part->unit_cost]);
        //         $update_part->stock = $update_part->stock - $qty;
        //         $update_part->save();
        //         if ($update_part->stock == 0) {
        //             $update_part->availability = 0;
        //             $update_part->save();
        //         }
        //     }
        // }
        // $log->parts_price = $order->parts->sum('total');
        // $log->save();
        return redirect()->route('work_order.index');
    }

    public function edit($id)
    {
        // $index['parts'] = PartsModel::where('stock', '>', 0)->where('availability', 1)->get();
        $index['data'] = WorkOrders::whereId($id)->first();
        $index['vehicles'] = VehicleModel::with('vehicleData')->get();

        $index['sites'] = Site::get();

        // $index['vendors'] = Vendor::get();
        // $index['mechanic'] = Mechanic::get();
        return view('work_orders.edit', $index);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $order = WorkOrders::find($request->get("id"));
        $order->site_id = $request->get('site_id');
        $order->vehicle_id = $request->get('vehicle_id');
        $order->driver_id = $request->get('driver_id');
        $order->shift_id = $request->get('shift_id');
        $order->status = $request->get('status');
        $order->description = $request->get('description');
        $order->date = $request->get('date');
        $order->start_meter = $request->get('start_meter');
        $order->work_hours = $request->get('work_hours') ?? '0';
        $order->price = $request->get('price');
        $order->user_id = Auth::user()->id;
        $order->save();

        $log = WorkOrderLogs::find($request->get("id"));
        $log->site_id = $request->get('site_id');
        $log->vehicle_id = $request->get('vehicle_id');
        $log->driver_id = $request->get('driver_id');
        $log->shift_id = $request->get('shift_id');
        $log->status = $request->get('status');
        $log->description = $request->get('description');
        $log->date = $request->get('date');
        $log->start_meter = $request->get('start_meter');
        $log->work_hours = $request->get('work_hours') ?? '0';
        $log->price = $request->get('price');
        $log->user_id = Auth::user()->id;
        $log->save();
        return redirect()->route('work_order.index');
    }

    public function close_shift(Request $request)
    {
        $vehicle_id = $request->get('vehicle_id');
        $driver_id = $request->get('driver_id');
        
        $order = WorkOrders::find($request->get("id"));
        $order->end_meter = $request->get('end_meter');
        $order->work_hours = $request->get('work_hours') ?? '0';
        $order->price = $request->get('price');
        $order->save();

        $log = WorkOrderLogs::find($request->get("id"));
        $log->end_meter = $request->get('end_meter');
        $log->work_hours = $request->get('work_hours') ?? '0';
        $log->price = $request->get('price');
        $log->save();

        DriverVehicleModel::where('driver_id', $driver_id)
            ->where('vehicle_id', $vehicle_id)
            ->delete(); //pending

        return redirect()->route('work_order.index');
    }

    public function destroy(Request $request)
    {
        WorkOrders::find($request->get('id'))->delete();
        return redirect()->back();
    }

    public function bulk_delete(Request $request)
    {
        WorkOrders::whereIn('id', $request->ids)->delete();
        return back();
    }

    public function remove_part($id)
    {
        $usedpart = PartsUsedModel::find($id);
        $part = PartsModel::find($usedpart->part_id);
        $part->stock = $part->stock + $usedpart->qty;
        $part->save();
        if ($part->stock > 0) {
            $part->availability = 1;
            $part->save();
        }
        $usedpart->delete();
        return back();
    }

    public function parts_used($id)
    {
        $order = WorkOrders::find($id);
        return view('work_orders.parts_used', compact('order'));
    }
}

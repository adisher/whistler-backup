<?php

/*
@copyright

Fleet Manager v6.1

Copyright (C) 2017-2022 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */

namespace App\Http\Controllers\Admin;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Model\Bookings;
use App\Model\CorrectiveMaintenance;
use App\Model\DriverPayments;
use App\Model\ExpCats;
// use App\Model\PartsModel;
use App\Model\Expense;
use App\Model\FuelAllocationModel;
use App\Model\FuelModel;
use App\Model\IncCats;
use App\Model\IncomeModel;
use App\Model\PartsModel;
use App\Model\PreventiveMaintenanceLogs;
use App\Model\Scheduled;
use App\Model\ServiceItemsModel;
use App\Model\ShiftDetails;
use App\Model\Site;
use App\Model\User;
use App\Model\VehicleModel;
use App\Model\Vendor;
use App\Model\WorkOrders;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:Reports add', ['only' => ['create']]);
        $this->middleware('permission:Reports edit', ['only' => ['edit']]);
        $this->middleware('permission:Reports delete', ['only' => ['bulk_delete', 'destroy']]);
        $this->middleware('permission:Reports list');
    }

    public function download(Request $request)
    {
        // dd($request->all());
        // Get report data from the request
        $reportData = $request->get('report');

        $filename = 'report_' . date('Y-m-d') . '.xlsx';
        $excelFile = Excel::download(new ReportExport($reportData), $filename);

        $path = 'reports/' . $filename;
        Storage::put($path, $excelFile);

        return $excelFile;

    }

    public function scheduled()
    {

        $years = collect(DB::select("select distinct year(date) as years from reports_scheduled where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }

        $data['vehicle_id'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;

        $data['scheduled'] = Scheduled::all();
        return view('reports.scheduled', $data);
    }

    public function templates()
    {
        return view('reports.template');
    }

    public function form(Request $request)
    {
        $recipients = DB::table('recipients')->get();
        return view('reports.template', compact('recipients'));
    }

    public function generate(Request $request)
    {
        return view('reports.template');
    }

    public function get_sites()
    {
        $sites = Site::all();
        return response()->json($sites);
    }

    public function get_fleet()
    {
        // $vehicles = VehicleModel::where('expense_type', 'rental')->get();
        $vehicles = VehicleModel::all();
        return response()->json($vehicles);
    }
    // Code from generate.blade.php
    public function demo_code()
    {
        // Code from generate.blade.php
        // case 'rental':
        // Add image to row
        // item.work_orders.forEach(function(
        //     work_order) {
        //     totalPrice +=
        //         parseFloat(
        //             work_order.price
        //         );
        // });
        // var imagePath;
        // var baseURL =
        //     'https://apis.ideationtec.com/whistler';
        // if (item.vehicle_image !== null) {
        //     imagePath = baseURL +
        //         '/uploads/' + item
        //         .vehicle_image;
        // } else {
        //     imagePath =
        //         '/assets/images/vehicle.jpeg';
        // }
        // var img = $('<img>').attr({
        //     src: imagePath,
        //     height: 70,
        //     width: 70
        // });
        // row.append($('<td>').append(img));
        // row.append('<td>' + item.fleet_no +
        //     '</td>');
        // row.append('<td>' + item
        //     .vehicle_data.make + ' ' +
        //     item.vehicle_data.model +
        //     '<br><strong>License Plate:</strong> ' +
        //     item.license_plate + '</td>'
        // );

        // row.append('<td>$' + totalPrice
        //     .toLocaleString(
        //         'en-US', {
        //             minimumFractionDigits: 2
        //         }) +
        //     '</td>');

        // row.append('<td>' + formattedDate +
        //     '</td>');

        // break;
    }

    public function fleet_data(Request $request)
    {
        // dd($request->all());
        $fleet_ids = json_decode($request->get('fleet_ids'), true);
        $parts_ids = json_decode($request->get('parts_ids'), true);
        $fuel_ids = json_decode($request->get('fuel_ids'), true);
        $site_ids = json_decode($request->get('sites'), true);
        $shifts = json_decode($request->get('shifts'), true);
        $rental_checked = $request->rental_checked;
        $shift_details = $request->shift_checked;
        $deployment_checked = $request->deployment_checked;
        $fuel_allocation_checked = $request->fuel_allocation_checked;
        $parts_allocation_checked = $request->parts_allocation_checked;
        $check_corrective_maintenance = $request->corrective_maintenance;
        $check_preventive_maintenance = $request->preventive_maintenance;

        // dd($check_preventive_maintenance);

        // Getting the date range and splitting it into start and end dates
        $date_range = explode(' - ', $request->get('date_range'));
        $start_date = $date_range[0];
        $end_date = $date_range[1];
        $fleet_rental = '';
        $shiftDetails = '';
        $deployment_data = '';
        $corrective_maintenance = '';
        $preventive_maintenance = '';
        $fuel_allocation = '';
        $parts_allocation = '';

        // Start building the main query
        $query = WorkOrders::with(['vehicle', 'sites', 'assigned_driver'])
            ->whereIn('vehicle_id', $fleet_ids)
            ->whereBetween('date', [$start_date, $end_date])
            ->orderBy('date', 'desc');

        // If site ids are selected, filter by site
        if ($deployment_checked == "true") {
            if ($site_ids) {
                $query->whereIn('site_id', $site_ids);
            }

            if ($shifts) {
                $query->whereIn('shift_id', $shifts);
            }
        }
        if ($shift_details == "true") {
            $shiftDetailsQuery = ShiftDetails::with(['site']);

            if ($site_ids) {
                $shiftDetailsQuery->whereIn('site_id', $site_ids);
            }

            if ($shifts) {
                $shiftDetailsQuery->whereIn('shift_id', $shifts);
            }

            $shiftDetails = $shiftDetailsQuery->get();

        }
        if ($check_corrective_maintenance == "true") {
            $corrective_maintenance = CorrectiveMaintenance::with(['vehicle', 'parts', 'parts.vendor'])
                ->whereIn('vehicle_id', $fleet_ids)
                ->whereBetween('date', [$start_date, $end_date]) // Apply date filter
                ->get()
                ->groupBy(['vehicle_id', function ($item) {
                    return $item->date; // Group by date
                }]);
        }

        if($fuel_allocation_checked == "true"){
            $fuel_allocation = FuelAllocationModel::with(['vehicle_data'])
                ->whereIn('vehicle_id', $fleet_ids)
                ->whereBetween('date', [$start_date, $end_date]) // Apply date filter
                ->get()
                ->groupBy(['vehicle_id', function ($item) {
                    return $item->date; // Group by date
                }]);
        }

        if($parts_allocation_checked == "true"){
            $parts_allocation = PreventiveMaintenanceLogs::with(['vehicle', 'services', 'parts', 'parts.vendor'])
                ->whereIn('vehicle_id', $fleet_ids)
                ->whereBetween('date', [$start_date, $end_date]) // Apply date filter
                ->get()
                ->groupBy(['vehicle_id', function ($item) {
                    return $item->date; // Group by date
                }]);
        }

        // Execute the query
        $fleet_rental = $query->get()
            ->groupBy(['vehicle_id', function ($item) {
                return $item->date; // Group by date
            }])
            ->sortByDesc(function ($item, $key) {
                return $key; // Sort groups by date in descending order
            });

        if ($check_preventive_maintenance == "true") {
            $preventive_maintenance = PreventiveMaintenanceLogs::with(['vehicle', 'services', 'parts', 'parts.vendor'])
                ->whereIn('vehicle_id', $fleet_ids)
                ->whereBetween('created_at', [$start_date, $end_date]) // Apply date filter
                ->get()
                ->groupBy(['vehicle_id', function ($item) {
                    return $item->date; // Group by date
                }]);
        }

        $fleet_data = VehicleModel::with(['vehicleData', 'workOrders'])
            ->whereIn('id', $fleet_ids)
            ->where('expense_type', 'rental')
            ->whereBetween('created_at', [$start_date, $end_date]) // Apply date filter
            ->get();

        $parts_data = PartsModel::with(['vendor'])
            ->whereIn('vendor_id', $parts_ids)
            ->whereBetween('date', [$start_date, $end_date]) // Apply date filter
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(['vendor_id', function ($item) {
                return $item->date; // Group by date
            }]);

        $fuel_data = FuelModel::with(['vendor'])
            ->whereIn('vendor_name', $fuel_ids)
            ->whereBetween('date', [$start_date, $end_date]) // Apply date filter
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(['vendor_name', function ($item) {
                return $item->date; // Group by date
            }]);

        return response()->json([
            'fleet_ids' => $fleet_ids,
            'rental' => $fleet_rental,
            'rental_checked' => $rental_checked,
            'parts' => $parts_data,
            'shift_details' => $shiftDetails,
            'shift_checked' => $shift_details,
            'fuel' => $fuel_data,
            'deployment' => $deployment_data,
            'corrective_maintenance' => $corrective_maintenance,
            'check_corrective_maintenance' => $check_corrective_maintenance,
            'preventive_maintenance' => $preventive_maintenance,
            'check_preventive_maintenance' => $check_preventive_maintenance,
            'fuel_allocation_checked' => $fuel_allocation_checked,
            'parts_allocation_checked' => $parts_allocation_checked,
            'fuel_allocation' => $fuel_allocation,
            'parts_allocation' => $parts_allocation,
        ]);
    }

    public function get_fuel(Request $request)
    {
        $fuel = Vendor::where('type', 'fuel')->get();
        return response()->json($fuel);
    }

    public function fuel_data(Request $request)
    {
        $ids = json_decode($request->get('ids'), true);

        // Fetch data from the database
        $data = VehicleModel::with(['vehicleData', 'workOrders'])->whereIn('id', $ids)->get();
        // $data = WorkOrders::with(['vehicle', 'vehicle.vehicleData'])->whereIn('vehicle_id', $ids)->get();
        return response()->json($data);
    }

    public function get_parts(Request $request)
    {
        $fuel = Vendor::where('type', 'parts')->get();
        return response()->json($fuel);
    }

    public function parts_data(Request $request)
    {
        $ids = json_decode($request->get('ids'), true);

        // Fetch data from the database
        $data = PartsModel::whereIn('id', $ids)->get();
        return response()->json($data);
    }

    public function expense()
    {
        $years = collect(DB::select("select distinct year(date) as years from expense where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }

        $data['vehicle_id'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;

        $data['expense'] = Expense::whereIn('vehicle_id', $vehicle_ids)->whereYear("date", date("Y"))->whereMonth("date", date('m'))->get();
        return view('reports.expense', $data);
    }

    public function expense_post(Request $request)
    {

        $years = collect(DB::select("select distinct year(date) as years from expense where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }

        $data['vehicle_id'] = $request->vehicle_id;
        $data['year_select'] = $request->year;
        $data['month_select'] = $request->month;
        $data['years'] = $y;

        $records = Expense::whereIn('vehicle_id', $vehicle_ids)->whereYear("date", $request->year)->whereMonth("date", $request->month);
        if ($request->vehicle_id != null) {
            $data['expense'] = $records->where('vehicle_id', $request->vehicle_id)->get();
        } else {
            $data['expense'] = $records->get();
        }
        return view('reports.expense', $data);
    }

    public function expense_print(Request $request)
    {
        $data['vehicle_id'] = $request->vehicle_id;
        $data['year_select'] = $request->year;
        $data['month_select'] = $request->month;
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get()->toArray();
        } else {

            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get()->toArray();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }
        $records = Expense::whereIn('vehicle_id', $vehicle_ids)->whereYear("date", $request->year)->whereMonth("date", $request->month);
        if ($request->vehicle_id != null) {
            $data['expense'] = $records->where('vehicle_id', $request->vehicle_id)->get();
        } else {
            $data['expense'] = $records->get();
        }
        return view('reports.print_expense', $data);
    }

    public function income()
    {

        $years = collect(DB::select("select distinct year(date) as years from income where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }

        $data['vehicle_id'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;

        $data['income'] = IncomeModel::whereIn('vehicle_id', $vehicle_ids)->whereYear("date", date("Y"))->whereMonth("date", date('m'))->get();
        return view('reports.income', $data);
    }

    public function income_post(Request $request)
    {
        $years = collect(DB::select("select distinct year(date) as years from income where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }

        $data['vehicle_id'] = $request->vehicle_id;
        $data['year_select'] = $request->year;
        $data['month_select'] = $request->month;
        $data['years'] = $y;

        $records = IncomeModel::whereYear("date", $request->year)->whereMonth("date", $request->month);
        if ($request->vehicle_id != null) {
            $data['income'] = $records->where('vehicle_id', $request->vehicle_id)->get();
        } else {
            $data['income'] = $records->whereIn('vehicle_id', $vehicle_ids)->get();
        }
        return view('reports.income', $data);
    }

    public function income_print(Request $request)
    {
        $data['vehicle_id'] = $request->vehicle_id;
        $data['year_select'] = $request->year;
        $data['month_select'] = $request->month;
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get()->toArray();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get()->toArray();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }

        $records = IncomeModel::whereYear("date", $request->year)->whereMonth("date", $request->month);
        if ($request->vehicle_id != null) {
            $data['income'] = $records->where('vehicle_id', $request->vehicle_id)->get();
        } else {
            $data['income'] = $records->whereIn('vehicle_id', $vehicle_ids)->get();
        }
        return view('reports.print_income', $data);
    }

    public function monthly()
    {

        $years = DB::select(DB::raw("select distinct year(date) as years from income  union select distinct year(date) as years from expense order by years desc"));
        $y = array();
        $c = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {

            $y[date('Y')] = date('Y');

        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }

        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['vehicle_select'] = null;
        $data['years'] = $y;
        $data['income'] = IncomeModel::select(DB::raw("SUM(amount) as income"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->whereIn('vehicle_id', $vehicle_ids)->get();
        $data['expenses'] = Expense::select(DB::raw("SUM(amount) as expense"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->whereIn('vehicle_id', $vehicle_ids)->get();
        $data['expense_by_cat'] = Expense::select("type", "expense_type", DB::raw("sum(amount) as expense"))->whereYear('date', date('Y'))->whereMonth('date', date('n'))->groupBy(['expense_type', 'type'])->whereIn('vehicle_id', $vehicle_ids)->get();

        $data['income_by_cat'] = IncomeModel::select("income_cat", DB::raw("sum(amount) as amount"))->whereYear('date', date('Y'))->whereMonth('date', date('n'))->groupBy(['income_cat'])->whereIn('vehicle_id', $vehicle_ids)->get();

        $ss = ServiceItemsModel::get();
        foreach ($ss as $s) {
            $c[$s->id] = $s->description;
        }

        $kk = ExpCats::get();

        foreach ($kk as $k) {
            $b[$k->id] = $k->name;

        }
        $hh = IncCats::get();

        foreach ($hh as $k) {
            $i[$k->id] = $k->name;

        }
        $data['service'] = $c;
        $data['expense_cats'] = $b;
        $data['income_cats'] = $i;
        $data['result'] = "";

        return view("reports.monthly", $data);
    }

    public function delinquent()
    {
        $years = collect(DB::select("select distinct year(date) as years from income where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }

        $data['vehicle_id'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;

        return view("reports.delinquent", $data);
    }

    public function booking()
    {
        $years = collect(DB::select("select distinct year(pickup) as years from bookings where deleted_at is null and pickup is not null order by years desc"));

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        $data['vehicle_select'] = "";
        $data['customer_select'] = "";
        $data['customers'] = User::where('user_type', 'C')->get();
        $data['years'] = $y;
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['bookings'] = Bookings::whereYear("pickup", date("Y"))->whereMonth("pickup", date("n"))->whereIn('vehicle_id', $vehicle_ids)->get();

        return view("reports.booking", $data);
    }

    public function booking_post(Request $request)
    {
        $years = collect(DB::select("select distinct year(pickup) as years from bookings where deleted_at is null and pickup is not null order by years desc"));

        $y = array();
        $data['customers'] = User::where('user_type', 'C')->get();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        $data['vehicle_select'] = $request->get('vehicle_id');
        $data['customer_select'] = $request->get('customer_id');
        $data['years'] = $y;
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['bookings'] = Bookings::whereYear("pickup", $data['year_select'])->whereMonth("pickup", $data['month_select'])->whereIn('vehicle_id', $vehicle_ids);
        if ($request->get("vehicle_id") != "") {
            $data['bookings'] = $data['bookings']->where("vehicle_id", $request->get("vehicle_id"));
        }
        if ($request->get("customer_id") != "") {
            $data['bookings'] = $data['bookings']->where("customer_id", $request->get("customer_id"));
        }
        $data['bookings'] = $data['bookings']->get();

        return view("reports.booking", $data);
    }
    public function delinquent_post(Request $request)
    {

        $years = DB::select(DB::raw("select distinct year(date) as years from income where deleted_at is null order by years desc"));
        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        foreach ($data['vehicles'] as $row) {
            $data['v'][$row['id']] = $row;
        }

        $data['vehicle_id'] = $request->get("vehicle_id");

        $income = IncomeModel::select(['vehicle_id', 'income_cat', 'date', DB::raw('sum(amount) as Income2,dayname(date) as day')])->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->groupBy('date')->orderBy('date');
        if ($data['vehicle_id'] != "") {
            $data['data'] = $income->where('vehicle_id', $data['vehicle_id'])->get();
        } else {
            $data['data'] = $income->whereIn('vehicle_id', $vehicle_ids)->get();
        }

        $data['years'] = $y;
        $data['result'] = "";

        return view("reports.delinquent", $data);
    }

    /*
    public function parts() {
    $data['parts'] = PartsModel::get();

    return view("reports.parts", $data);
    }
    public function parts_post(Request $request) {
    $data['parts'] = PartsModel::get();
    $data['parts2'] = TransactionModel::wherePart_id($request->get("part"))->get();

    $data['result'] = "";
    return view("reports.parts", $data);
    }
     */

    public function monthly_post(Request $request)
    {

        $years = DB::select(DB::raw("select distinct year(date) as years from income  union select distinct year(date) as years from expense order by years desc"));
        $y = array();
        $b = array();
        $i = array();
        $c = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        $data['vehicle_select'] = $request->get("vehicle_id");

        $income1 = IncomeModel::select(DB::raw("SUM(amount) as income"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->whereIn('vehicle_id', $vehicle_ids);
        $expense1 = Expense::select(DB::raw("SUM(amount) as expense"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->whereIn('vehicle_id', $vehicle_ids);
        $expense2 = Expense::select("type", "expense_type", DB::raw("sum(amount) as expense"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->whereIn('vehicle_id', $vehicle_ids)->groupBy(['expense_type', 'type']);
        $income2 = IncomeModel::select("income_cat", DB::raw("sum(amount) as amount"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->whereIn('vehicle_id', $vehicle_ids)->groupBy(['income_cat']);
        if ($data['vehicle_select'] != "") {
            $data['income'] = $income1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expenses'] = $expense1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expense_by_cat'] = $expense2->where('vehicle_id', $data['vehicle_select'])->get();
            $data['income_by_cat'] = $income2->where('vehicle_id', $data['vehicle_select'])->get();
        } else {
            $data['income'] = $income1->get();
            $data['expenses'] = $expense1->get();
            $data['expense_by_cat'] = $expense2->get();
            $data['income_by_cat'] = $income2->get();
        }

        $ss = ServiceItemsModel::get();
        foreach ($ss as $s) {
            $c[$s->id] = $s->description;
        }

        $kk = ExpCats::get();

        foreach ($kk as $k) {
            $b[$k->id] = $k->name;

        }
        $hh = IncCats::get();

        foreach ($hh as $k) {
            $i[$k->id] = $k->name;

        }
        $data['service'] = $c;
        $data['expense_cats'] = $b;
        $data['income_cats'] = $i;

        $data['years'] = $y;
        $data['result'] = "";
        return view("reports.monthly", $data);
    }

    public function fuel_()
    {
        $years = collect(DB::select("select distinct year(date) as years from income where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }
        $data['fuel'] = FuelAllocationModel::whereIn('vehicle_id', $vehicle_ids)->get();
        $data['vehicle_id'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;
        return view('reports.fuel', $data);
    }

    public function fuel_post(Request $request)
    {

        $years = collect(DB::select("select distinct year(date) as years from income where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }

        $data['vehicle_id'] = $request->get('vehicle_id');
        $data['year_select'] = $request->get('year');
        $data['month_select'] = $request->get('month');
        $data['years'] = $y;
        $v = " and vehicle_id=" . $data['vehicle_id'];
        if ($request->get('month') == '0') {
            $data['fuel'] = FuelAllocationModel::whereYear('date', $data['year_select'])->where('vehicle_id', $request->get('vehicle_id'))->get();

        } else {
            $data['fuel'] = FuelAllocationModel::whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->where('vehicle_id', $request->get('vehicle_id'))->get();
        }

        $data['result'] = "";
        return view('reports.fuel', $data);
    }

    public function yield ()
    {
        $years = collect(DB::select("select distinct year(date) as years from product_yields where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        $data['sites'] = ProductYield::all();

        $site_names = array(0);
        foreach ($data['sites'] as $s) {
            $site_names[] = $s['site_name'];
        }

        $data['site'] = ProductYield::whereIn('site_name', $site_names)->get();
        $data['site_name'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = "0";
        $data['years'] = $y;
        return view('reports.product_yield', $data);
    }

    public function yield_post(Request $request)
    {
        $parameters = [];
        // Date range selection
        $daterange = $request->get('daterange');

        if (!empty($daterange)) {
            [$start_date, $end_date] = explode(' - ', $daterange);

            $parameters[] = function ($query) use ($start_date, $end_date) {
                $query->whereDate('created_at', '>=', Carbon::parse($start_date))
                    ->whereDate('created_at', '<=', Carbon::parse($end_date));
            };
        }

        $data['sites'] = ProductYield::all();

        $data['site'] = $request->get('site_name');

        // dd($data['site']);
        if ($request->get('site_name') !== null) {
            // Site_name is selected
            $parameters[] = function ($query) use ($request) {
                $query->where('site_name', $request->get('site_name'));
            };
        }

        if (count($parameters) > 0) {
            $data['yield'] = ProductYield::where(function ($query) use ($parameters) {
                foreach ($parameters as $parameter) {
                    $query->where($parameter);
                }
            })->get();
        } else {
            // Default case when no value is selected
            $data['yield'] = ProductYield::all();
        }

        $data['result'] = "";
        return view('reports.product_yield', $data);
    }

    public function fleet(Request $request)
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::all();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle['id'];
        }

        $data['sites'] = ProductYield::all();

        $site_ids = array(0);
        foreach ($data['sites'] as $s) {
            $site_ids[] = $s['site_id'];
        }

        $daterange = $request->get('daterange');
        if (!empty($daterange)) {
            [$start_date, $end_date] = explode(' - ', $daterange);

            $parameters[] = ['created_at', '>=', Carbon::parse($start_date)];
            $parameters[] = ['created_at', '<=', Carbon::parse($end_date)];
        }

        // Include the start and end dates in the data array you're sending to your view
        $data['start_date'] = isset($start_date) ? $start_date : null;
        $data['end_date'] = isset($end_date) ? $end_date : null;

        $data['site'] = ProductYield::whereIn('id', $site_ids)->get();
        $data['site_id'] = "";
        $data['vehicle_id'] = "";
        return view('reports.fleet', $data);
    }

    public function fleet_post(Request $request)
    {

        // if ($request->ajax()) {

        //     $user = Auth::user();
        //     if ($user->group_id == null || $user->user_type == "S") {
        //         $vehicles = VehicleModel::select('vehicles.*', 'users.name as name');
        //     } else {
        //         $vehicles = VehicleModel::select('vehicles.*')->where('vehicles.group_id', $user->group_id);
        //     }
        //     $vehicles = $vehicles
        //         ->leftJoin('driver_vehicle', 'driver_vehicle.vehicle_id', '=', 'vehicles.id')
        //         ->leftJoin('users', 'users.id', '=', 'driver_vehicle.driver_id')
        //         ->leftJoin('users_meta', 'users_meta.id', '=', 'users.id')
        //         ->groupBy('vehicles.id');

        //     $vehicles->with(['group', 'types', 'drivers']);

        //     return DataTables::eloquent($vehicles)
        //         ->editColumn('vehicle_image', function ($vehicle) {
        //             $src = ($vehicle->vehicle_image != null) ? asset('uploads/' . $vehicle->vehicle_image) : asset('assets/images/vehicle.jpeg');

        //             return '<img src="' . $src . '" height="70px" width="70px">';
        //         })
        //         ->addColumn('make', function ($vehicle) {
        //             $html = (($vehicle->make_name) ? $vehicle->make_name : '') . ' - ';
        //             $html .= (($vehicle->model_name) ? $vehicle->model_name : '') . ' - ';
        //             $html .= (($vehicle->engine_type) ? $vehicle->engine_type : '');
        //             $html .= ' </br> <strong>Type: </strong>';
        //             $html .= (($vehicle->type_id) ? $vehicle->types->displayname : '');
        //             $html .= ' </br> <strong>Condition: </strong>';
        //             $html .= (($vehicle->fleet_condition) ? $vehicle->fleet_condition : '');
        //             $html .= ' </br> <strong>Color: </strong>';
        //             $html .= (($vehicle->color_name) ? $vehicle->color_name : '');

        //             return $html;
        //         })
        //         ->editColumn('license_plate', function ($vehicle) {
        //             return $vehicle->license_plate;
        //         })
        //         ->addColumn('in_service', function ($vehicle) {
        //             return ($vehicle->in_service) ? "YES" : "NO";
        //         })
        //         ->filterColumn('in_service', function ($query, $keyword) {
        //             $query->whereRaw("IF(in_service = 1, 'YES', 'NO') like ?", ["%{$keyword}%"]);
        //         })
        //         ->addColumn('assigned_driver', function ($vehicle) {
        //             $drivers = $vehicle->drivers->pluck('name')->toArray() ?? ['N/A'];
        //             return implode(', ', $drivers);
        //         })
        //         ->filterColumn('assigned_driver', function ($query, $keyword) {
        //             $query->whereRaw("users.name like ?", ["%$keyword%"]);
        //             return $query;
        //         })
        //         ->addIndexColumn()
        //         ->rawColumns(['vehicle_image', 'make'])
        //         ->make(true);
        //     //return datatables(User::all())->toJson();

        // }

        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::all();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $query = VehicleModel::query();
        $data['sites'] = ProductYield::all();

        $daterange = $request->get('daterange');

        // Filter by date range if specified
        if ($daterange !== "Invalid date - Invalid date") {
            [$start_date, $end_date] = explode(' - ', $daterange);
            $query->whereBetween('created_at', [Carbon::parse($start_date), Carbon::parse($end_date)]);
        }

        // Include the start and end dates in the data array you're sending to your view
        $data['start_date'] = isset($start_date) ? $start_date : null;
        $data['end_date'] = isset($end_date) ? $end_date : null;

        // Filter by site_id if specified
        $data['site_id'] = $request->get('site_id');
        if ($request->get('site_id') !== null) {
            $query->whereHas('sites', function ($query) use ($data) {
                $query->where('product_yields.id', $data['site_id']);
            });
        }

        // Filter by vehicle_id if specified
        $data['vehicle_id'] = $request->get('vehicle_id');
        if ($request->get('vehicle_id') !== null) {
            $query->where('id', $data['vehicle_id']);
        }

        // Get the results with related drivers and sites
        $data['yield'] = $query->with(['drivers', 'sites'])->get();

        // Prepare the drivers and site names
        $data['drivers'] = [];
        $data['site_names'] = [];

        foreach ($data['yield'] as $vehicle) {
            foreach ($vehicle->drivers as $driver) {
                $data['drivers'][] = $driver->name;
            }
            foreach ($vehicle->sites as $site) {
                $data['site_names'][] = $site->site_name;
            }
        }

        $data['fleet_result'] = "";
        return view('reports.fleet', $data);

    }

    public function yearly()
    {
        $years = DB::select(DB::raw("select distinct year(date) as years from income  union select distinct year(date) as years from expense order by years desc"));
        $y = array();
        $c = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {

            $y[date('Y')] = date('Y');

        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }

        $data['year_select'] = date("Y");

        $data['vehicle_select'] = null;
        $data['years'] = $y;
        $data['income'] = IncomeModel::select(DB::raw('sum(amount) as income'))->whereYear('date', date('Y'))->whereIn('vehicle_id', $vehicle_ids)->get();
        $data['expenses'] = Expense::select(DB::raw('sum(amount) as expense'))->whereYear('date', date("Y"))->whereIn('vehicle_id', $vehicle_ids)->get();
        $data['expense_by_cat'] = Expense::select(['type', 'expense_type', DB::raw('sum(amount) as expense')])->whereYear('date', date('Y'))->whereIn('vehicle_id', $vehicle_ids)->groupBy(['expense_type', 'type'])->get();
        $data['income_by_cat'] = IncomeModel::select(['income_cat', DB::raw('sum(amount) as amount')])->whereYear('date', date('Y'))->whereIn('vehicle_id', $vehicle_ids)->groupBy('income_cat')->get();

        $ss = ServiceItemsModel::get();
        foreach ($ss as $s) {
            $c[$s->id] = $s->description;
        }

        $kk = ExpCats::get();

        foreach ($kk as $k) {
            $b[$k->id] = $k->name;

        }
        $hh = IncCats::get();

        foreach ($hh as $k) {
            $i[$k->id] = $k->name;

        }

        $data['service'] = $c;
        $data['expense_cats'] = $b;
        $data['income_cats'] = $i;
        $data['result'] = "";
        return view('reports.yearly', $data);
    }

    public function yearly_post(Request $request)
    {

        $years = DB::select(DB::raw("select distinct year(date) as years from income  union select distinct year(date) as years from expense order by years desc"));
        $y = array();
        $b = array();
        $i = array();
        $c = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['year_select'] = $request->get("year");
        $data['vehicle_select'] = $request->get("vehicle_id");

        $income1 = IncomeModel::select(DB::raw("sum(amount) as income"))->whereYear('date', $data['year_select']);
        $expense1 = Expense::select(DB::raw("sum(amount) as expense"))->whereYear('date', $data['year_select']);
        $expense2 = Expense::select("type", "expense_type", DB::raw("sum(amount) as expense"))->whereYear('date', $data['year_select'])->groupBy('expense_type', 'type');
        $income2 = IncomeModel::select('income_cat', DB::raw("sum(amount) as amount"))->whereYear('date', $data['year_select'])->groupBy('income_cat');
        if ($data['vehicle_select'] != "") {
            $data['income'] = $income1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expenses'] = $expense1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expense_by_cat'] = $expense2->where('vehicle_id', $data['vehicle_select'])->get();
            $data['income_by_cat'] = $income2->where('vehicle_id', $data['vehicle_select'])->get();
        } else {
            $data['income'] = $income1->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['expenses'] = $expense1->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['expense_by_cat'] = $expense2->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['income_by_cat'] = $income2->whereIn('vehicle_id', $vehicle_ids)->get();
        }

        $ss = ServiceItemsModel::get();
        foreach ($ss as $s) {
            $c[$s->id] = $s->description;
        }

        $kk = ExpCats::get();

        foreach ($kk as $k) {
            $b[$k->id] = $k->name;

        }
        $hh = IncCats::get();

        foreach ($hh as $k) {
            $i[$k->id] = $k->name;

        }

        $data['service'] = $c;
        $data['expense_cats'] = $b;
        $data['income_cats'] = $i;

        $data['years'] = $y;
        $data['result'] = "";
        return view('reports.yearly', $data);
    }

    public function drivers_payments()
    {
        $bookings = Bookings::whereNotNull('driver_id')->orderBy('bookings.id', 'desc')
            ->meta()->where(function ($q) {
            $q->where('bookings_meta.key', 'receipt');
            $q->where('bookings_meta.value', 1);
        })
            ->get();

        $index['driver_payments'] = DriverPayments::latest()->get()->toBase()->merge($bookings);
        $index['drivers'] = User::where('user_type', 'D')->has('bookings')->orderBy('name')->pluck('name', 'id')->toArray();

        $driver_bookings = Bookings::whereIn('driver_id', array_keys($index['drivers']))->get();

        $driver_remaining_amounts = User::where('user_type', 'D')->has('bookings')->get();

        $driver_amount = [];

        foreach ($driver_remaining_amounts as $dram) {
            $driver_amount[$dram->id]['data-remaining-amount'] = $dram->remaining_amount;
        }

        foreach ($driver_bookings as $am) {
            $amount = $am->driver_amount ?? $am->tax_total;

            if (!empty($driver_amount[$am->driver_id]['data-amount'])) {
                $driver_amount[$am->driver_id]['data-amount'] = $driver_amount[$am->driver_id]['data-amount'] + $amount;
            } else {
                $driver_amount[$am->driver_id]['data-amount'] = $amount;
            }
        }
        $index['driver_booking_amount'] = $driver_amount;
        // dd($index);
        return view('reports.driver_payments', $index);
    }

    public function drivers_payments_post(Request $request)
    {
        $this->validate($request, [
            'driver' => 'required',
            'amount' => 'required',
        ]);
        DriverPayments::create([
            'user_id' => auth()->id(),
            'driver_id' => $request->driver,
            'amount' => $request->amount,
            'notes' => $request->notes,
        ]);
        $driver = User::find($request->driver);
        $remainig_amount_after_saved = $request->remaining_amount_hidden - $request->amount;
        $driver->remaining_amount = $remainig_amount_after_saved;
        $driver->save();

        return back()->with('msg', trans('fleet.driverPaymentAdded'));
    }

    public function vendors()
    {

        // $data['details'] = DB::select(DB::raw("select vendor_id,sum(price) as total from work_orders where deleted_at is null group by vendor_id"));
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['details'] = WorkOrders::select(['vendor_id', DB::raw('sum(price) as total')])->whereIn('vehicle_id', $vehicle_ids)->groupBy('vendor_id')->get();
        // dd($data);

        $kk = WorkOrders::select('vendor_id')->whereIn('vehicle_id', $vehicle_ids)->groupBy('vendor_id')->get();
        $b = array();
        foreach ($kk as $k) {
            $b[$k->vendor_id] = $k->vendor->name;

        }
        $data['vendors'] = $b;
        $data['date1'] = null;
        $data['date2'] = null;
        return view('reports.vendor', $data);
    }

    public function vendors_post(Request $request)
    {

        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $start = date('Y-m-d H:i:s', strtotime($request->get('date1')));

        $end = date('Y-m-d H:i:s', strtotime($request->get('date2')));
        $data['details'] = WorkOrders::select(['vendor_id', DB::raw('sum(price) as total')])->whereBetween('created_at', [$start, $end])->whereIn('vehicle_id', $vehicle_ids)->groupBy('vendor_id')->get();

        $kk = WorkOrders::select('vendor_id')->whereIn('vehicle_id', $vehicle_ids)->groupBy('vendor_id')->get();
        $b = array();
        foreach ($kk as $k) {
            $b[$k->vendor_id] = $k->vendor->name;

        }
        $data['vendors'] = $b;
        $data['date1'] = $request->date1;
        $data['date2'] = $request->date2;
        return view('reports.vendor', $data);

    }

    public function drivers()
    {

        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        // data of current month and current year
        $drivers = Bookings::select(['id', 'driver_id', 'vehicle_id'])->where('status', 1)->whereIn('vehicle_id', $vehicle_ids)->groupBy('driver_id')->get();
        $drivers_by_year = array();
        foreach ($drivers as $d) {
            $drivers_by_year[$d->driver->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", date("Y"))->where('driver_id', $d->driver_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }
        // dd($drivers_by_year);
        $data['drivers_by_year'] = $drivers_by_year;
        $drivers_by_month = array();
        foreach ($drivers as $d) {
            $drivers_by_month[$d->driver->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", date("Y"))->whereMonth("bookings.updated_at", date("n"))->where('driver_id', $d->driver_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }
        $data['drivers_by_month'] = $drivers_by_month;
        // dd($drivers_by_month);
        $years = collect(DB::select("select distinct year(created_at) as years from bookings where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }

        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;
        return view('reports.driver', $data);

    }

    public function drivers_post(Request $request)
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        // data of selected month and year
        $drivers = Bookings::select(['id', 'driver_id', 'vehicle_id'])->where('status', 1)->whereIn('vehicle_id', $vehicle_ids)->groupBy('driver_id')->get();
        $drivers_by_year = array();
        foreach ($drivers as $d) {
            $drivers_by_year[$d->driver->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", $request->get("year"))->where('driver_id', $d->driver_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }
        // dd($drivers_by_year);
        $data['drivers_by_year'] = $drivers_by_year;

        $drivers_by_month = array();
        foreach ($drivers as $d) {
            $drivers_by_month[$d->driver->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", $request->get('year'))->whereMonth("bookings.updated_at", $request->get("month"))->where('driver_id', $d->driver_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }

        // dd($drivers_by_month);
        $data['drivers_by_month'] = $drivers_by_month;

        $years = collect(DB::select("select distinct year(created_at) as years from bookings where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        $data['years'] = $y;

        return view('reports.driver', $data);

    }

    public function customers()
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        // data of current month and current year
        $customers = Bookings::select(['id', 'customer_id', 'vehicle_id'])->where('status', 1)->whereIn('vehicle_id', $vehicle_ids)->groupBy('customer_id')->get();
        $customers_by_year = array();
        foreach ($customers as $d) {
            $customers_by_year[$d->customer->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", date("Y"))->where('customer_id', $d->customer_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }

        $data['customers_by_year'] = $customers_by_year;
        arsort($customers_by_year);
        $data['top10'] = array_slice($customers_by_year, 0, 10);

        $customers_by_month = array();
        foreach ($customers as $d) {
            $customers_by_month[$d->customer->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", date("Y"))->whereMonth("bookings.updated_at", date("n"))->where('customer_id', $d->customer_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }
        $data['customers_by_month'] = $customers_by_month;
        $years = collect(DB::select("select distinct year(created_at) as years from bookings where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }

        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;
        return view('reports.customer', $data);

    }

    public function customers_post(Request $request)
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        // data of selected month and year
        $customers = Bookings::select(['id', 'customer_id', 'vehicle_id'])->where('status', 1)->whereIn('vehicle_id', $vehicle_ids)->groupBy('customer_id')->get();
        $customers_by_year = array();
        foreach ($customers as $d) {
            $customers_by_year[$d->customer->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", $request->get("year"))->where('customer_id', $d->customer_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }
        $data['customers_by_year'] = $customers_by_year;

        arsort($customers_by_year);
        $data['top10'] = array_slice($customers_by_year, 0, 10);
        $customers_by_month = array();
        foreach ($customers as $d) {
            $customers_by_month[$d->customer->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", $request->get("year"))->whereMonth("bookings.updated_at", $request->get("month"))->where('customer_id', $d->customer_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }
        $data['customers_by_month'] = $customers_by_month;

        $years = collect(DB::select("select distinct year(created_at) as years from bookings where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        $data['years'] = $y;

        return view('reports.customer', $data);

    }

    public function print_deliquent(Request $request)
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        foreach ($data['vehicles'] as $row) {
            $data['v'][$row['id']] = $row;
        }

        $data['vehicle_id'] = $request->get("vehicle_id");
        $income = IncomeModel::select(['vehicle_id', 'income_cat', 'date', DB::raw('sum(amount) as Income2,dayname(date) as day')])->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->groupBy('date')->orderBy('date');
        if ($data['vehicle_id'] != "") {
            $data['data'] = $income->where('vehicle_id', $data['vehicle_id'])->get();
        } else {
            $data['data'] = $income->whereIn('vehicle_id', $vehicle_ids)->get();
        }

        $data['vehicle'] = VehicleModel::find($request->get('vehicle_id'));
        return view('reports.print_delinquent', $data);
    }

    public function print_monthly(Request $request)
    {
        $b = array();
        $i = array();
        $c = array();

        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        $data['vehicle_select'] = $request->get("vehicle_id");
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }

        $income1 = IncomeModel::select(DB::raw("SUM(amount) as income"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select']);
        $expense1 = Expense::select(DB::raw("SUM(amount) as expense"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select']);
        $expense2 = Expense::select("type", "expense_type", DB::raw("sum(amount) as expense"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->groupBy(['expense_type', 'type']);
        $income2 = IncomeModel::select("income_cat", DB::raw("sum(amount) as amount"))->whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->groupBy(['income_cat']);
        if ($data['vehicle_select'] != "") {
            $data['income'] = $income1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expenses'] = $expense1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expense_by_cat'] = $expense2->where('vehicle_id', $data['vehicle_select'])->get();
            $data['income_by_cat'] = $income2->where('vehicle_id', $data['vehicle_select'])->get();
        } else {
            $data['income'] = $income1->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['expenses'] = $expense1->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['expense_by_cat'] = $expense2->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['income_by_cat'] = $income2->whereIn('vehicle_id', $vehicle_ids)->get();
        }

        $kk = ExpCats::get();
        $ss = ServiceItemsModel::get();
        foreach ($ss as $s) {
            $c[$s->id] = $s->description;
        }

        foreach ($kk as $k) {
            $b[$k->id] = $k->name;

        }

        $hh = IncCats::get();

        foreach ($hh as $k) {
            $i[$k->id] = $k->name;

        }
        $data['service'] = $c;
        $data['expense_cats'] = $b;
        $data['income_cats'] = $i;

        $data['vehicle'] = VehicleModel::find($request->get("vehicle_id"));

        return view('reports.print_monthly', $data);

    }

    public function print_booking(Request $request)
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['customers'] = User::where('user_type', 'C')->get();
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        $data['bookings'] = Bookings::whereMonth("pickup", $data['month_select'])->whereMonth("pickup", $data['month_select'])->whereIn('vehicle_id', $vehicle_ids);
        if ($request->get("vehicle_id") != "") {
            $data['bookings'] = $data['bookings']->where("vehicle_id", $request->get("vehicle_id"));
        }
        if ($request->get("customer_id") != "") {
            $data['bookings'] = $data['bookings']->where("customer_id", $request->get("customer_id"));
        }
        $data['bookings'] = $data['bookings']->get();
        return view('reports.print_bookings', $data);
    }

    public function print_fuel(Request $request)
    {

        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }

        $data['vehicle_id'] = $request->get('vehicle_id');
        $data['year_select'] = $request->get('year');
        $data['month_select'] = $request->get('month');

        if ($request->get('month') == '0') {
            $data['fuel'] = FuelModel::whereYear('date', $data['year_select'])->where('vehicle_id', $request->get('vehicle_id'))->get();

        } else {
            $data['fuel'] = FuelModel::whereYear('date', $data['year_select'])->whereMonth('date', $data['month_select'])->where('vehicle_id', $request->get('vehicle_id'))->get();
        }
        $data['vehicle'] = VehicleModel::find($request->get('vehicle_id'));

        return view('reports.print_fuel', $data);
    }

    public function print_yearly(Request $request)
    {

        $b = array();
        $i = array();
        $c = array();

        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }

        $data['year_select'] = $request->get("year");
        $data['vehicle_select'] = $request->get("vehicle_id");

        $income1 = IncomeModel::select(DB::raw("sum(amount) as income"))->whereYear('date', $data['year_select']);
        $expense1 = Expense::select(DB::raw("sum(amount) as expense"))->whereYear('date', $data['year_select']);
        $expense2 = Expense::select("type", "expense_type", DB::raw("sum(amount) as expense"))->whereYear('date', $data['year_select'])->groupBy('expense_type', 'type');
        $income2 = IncomeModel::select('income_cat', DB::raw("sum(amount) as amount"))->whereYear('date', $data['year_select'])->groupBy('income_cat');
        if ($data['vehicle_select'] != "") {
            $data['income'] = $income1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expenses'] = $expense1->where('vehicle_id', $data['vehicle_select'])->get();
            $data['expense_by_cat'] = $expense2->where('vehicle_id', $data['vehicle_select'])->get();
            $data['income_by_cat'] = $income2->where('vehicle_id', $data['vehicle_select'])->get();
        } else {
            $data['income'] = $income1->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['expenses'] = $expense1->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['expense_by_cat'] = $expense2->whereIn('vehicle_id', $vehicle_ids)->get();
            $data['income_by_cat'] = $income2->whereIn('vehicle_id', $vehicle_ids)->get();
        }

        $ss = ServiceItemsModel::get();
        foreach ($ss as $s) {
            $c[$s->id] = $s->description;
        }

        $kk = ExpCats::get();

        foreach ($kk as $k) {
            $b[$k->id] = $k->name;

        }
        $hh = IncCats::get();

        foreach ($hh as $k) {
            $i[$k->id] = $k->name;

        }

        $data['service'] = $c;
        $data['expense_cats'] = $b;
        $data['income_cats'] = $i;

        $data['vehicle'] = VehicleModel::find($request->get('vehicle_id'));

        return view('reports.print_yearly', $data);
    }

    public function print_driver(Request $request)
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }

        $drivers = Bookings::select(['id', 'driver_id', 'vehicle_id'])->whereIn('vehicle_id', $vehicle_ids)->where('status', 1)->groupBy('driver_id')->get();

        $drivers_by_month = array();
        foreach ($drivers as $d) {
            $drivers_by_month[$d->driver->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", $request->get('year'))->whereMonth("bookings.updated_at", $request->get("month"))->where('driver_id', $d->driver_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }

        $data['drivers_by_month'] = $drivers_by_month;

        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");

        return view('reports.print_driver', $data);
    }

    public function print_vendor()
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['details'] = WorkOrders::select(['vendor_id', DB::raw('sum(price) as total')])->whereIn('vehicle_id', $vehicle_ids)->groupBy('vendor_id')->get();

        $kk = WorkOrders::select('vendor_id')->whereIn('vehicle_id', $vehicle_ids)->groupBy('vendor_id')->get();
        $b = array();
        foreach ($kk as $k) {
            $b[$k->vendor_id] = $k->vendor->name;

        }
        $data['vendors'] = $b;

        return view('reports.print_vendor', $data);
    }

    public function print_customer(Request $request)
    {
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $customers = Bookings::select(['id', 'customer_id', 'vehicle_id'])->where('status', 1)->whereIn('vehicle_id', $vehicle_ids)->groupBy('customer_id')->get();
        $customers_by_year = array();
        foreach ($customers as $d) {
            $customers_by_year[$d->customer->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", $request->get("year"))->where('customer_id', $d->customer_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }
        $data['customers_by_year'] = $customers_by_year;

        arsort($customers_by_year);
        $data['top10'] = array_slice($customers_by_year, 0, 10);

        $customers_by_month = array();
        foreach ($customers as $d) {
            $customers_by_month[$d->customer->name] = Bookings::meta()
                ->where(function ($query) {
                    $query->where('bookings_meta.key', '=', 'tax_total');

                })->whereYear("bookings.updated_at", $request->get("year"))->whereMonth("bookings.updated_at", $request->get("month"))->where('customer_id', $d->customer_id)->whereIn('vehicle_id', $vehicle_ids)->sum('value');

        }

        $data['customers_by_month'] = $customers_by_month;

        $years = collect(DB::select("select distinct year(created_at) as years from bookings where deleted_at is null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        $data['years'] = $y;
        return view('reports.print_customer', $data);
    }

    public function users()
    {
        $years = collect(DB::select("select distinct year(pickup) as years from bookings where deleted_at is null and pickup is not null order by years desc"))->toArray();

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        $data['users'] = User::where('user_type', 'O')->orWhere('user_type', 'S')->get();
        $data['user_id'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;
        return view('reports.users', $data);
    }

    public function users_post(Request $request)
    {
        $years = DB::select(DB::raw("select distinct year(pickup) as years from bookings where deleted_at is null and pickup is not null order by years desc"));
        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        $data['users'] = User::where('user_type', 'O')->orWhere('user_type', 'S')->get();
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");

        $data['user_id'] = $request->get("user_id");
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }

        $data['data'] = Bookings::whereYear('pickup', $data['year_select'])->whereMonth('pickup', $data['month_select'])->where('user_id', $request->get('user_id'))->whereIn('vehicle_id', $vehicle_ids)->get();

        $data['years'] = $y;
        $data['result'] = "";

        return view("reports.users", $data);
    }

    public function print_users(Request $request)
    {

        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");
        if (Auth::user()->group_id == null || Auth::user()->user_type == "S") {
            $data['vehicles'] = VehicleModel::get();
        } else {
            $data['vehicles'] = VehicleModel::where('group_id', Auth::user()->group_id)->get();
        }
        $vehicle_ids = array(0);
        foreach ($data['vehicles'] as $vehicle) {
            $vehicle_ids[] = $vehicle->id;
        }
        $data['data'] = Bookings::whereYear('pickup', $data['year_select'])->whereMonth('pickup', $data['month_select'])->where('user_id', $request->get('user_id'))->whereIn('vehicle_id', $vehicle_ids)->get();

        return view('reports.print_users', $data);
    }

    public function work_order()
    {
        $years = DB::select(DB::raw("select distinct year(required_by) as years from work_orders where deleted_at is null and required_by is not null order by years desc"));

        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }

        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        $data['vehicle'] = VehicleModel::all();
        $data['vehicle_id'] = "";
        $data['year_select'] = date("Y");
        $data['month_select'] = date("n");
        $data['years'] = $y;
        return view('reports.work_order', $data);
    }

    public function get_deployed_fleet(Request $request)
    {
        $siteId = $request->get('site_id');
        $shiftId = $request->get('shift_id');
        $reportDate = $request->get('date');
        // dd($siteId, $shiftId, $reportDate);

        $workOrders = WorkOrders::with('vehicle')
            ->where('site_id', $siteId)
            ->where('shift_id', $shiftId)
            ->where('date', $reportDate)
            ->get();

        // dd($workOrders);

        $vehicles = [];
        foreach ($workOrders as $order) {
            $vehicles[$order->vehicle->id] = $order->vehicle->vehicleData->make . ' ' . $order->vehicle->vehicleData->model . ' - ' . $order->vehicle->license_plate;
        }

        if ($vehicles) {
            return response()->json(['fleet_details' => $vehicles]);
        }

    }

    public function work_order_post(Request $request)
    {
        $years = DB::select(DB::raw("select distinct year(required_by) as years from work_orders where deleted_at is null and required_by is not null order by years desc"));
        $y = array();
        foreach ($years as $year) {
            $y[$year->years] = $year->years;
        }
        if ($years == null) {
            $y[date('Y')] = date('Y');
        }
        $data['vehicle'] = VehicleModel::all();
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");

        $data['vehicle_id'] = $request->get("vehicle_id");

        $data['data'] = WorkOrders::whereYear('required_by', $data['year_select'])->whereMonth('required_by', $data['month_select'])->where('vehicle_id', $request->get('vehicle_id'))->get();

        $data['years'] = $y;
        $data['result'] = "";

        return view("reports.work_order", $data);
    }

    public function print_workOrder_report(Request $request)
    {
        $data['year_select'] = $request->get("year");
        $data['month_select'] = $request->get("month");

        $data['data'] = WorkOrders::whereYear('required_by', $data['year_select'])->whereMonth('required_by', $data['month_select'])->where('vehicle_id', $request->get('vehicle_id'))->get();
        return view("reports.print_work_order", $data);
    }
}

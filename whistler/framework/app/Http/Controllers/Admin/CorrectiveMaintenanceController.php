<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CorrectiveMaintenance;
use App\Model\PartsModel;
use App\Model\User;
use App\Model\VehicleModel;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CorrectiveMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance = CorrectiveMaintenance::with(['vehicle.makeModel'])->select('*')->get();
        return view("maintenance.index", compact('maintenance'));

    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $user = Auth::user();
            $maintenance = CorrectiveMaintenance::select('corrective_maintenance.*')->with(['vehicle.makeModel', 'parts']);

            return DataTables::eloquent($maintenance)
                ->addColumn('check', function ($maint) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $maint->id . '" class="checkbox" id="chk' . $maint->id . '" onclick=\'checkcheckbox();\'>';
                    return $tag;
                })
                ->editColumn('id', function ($maint) {
                    return $maint->id;
                })
                ->addColumn('vehicle_id', function ($maint) {
                    return ($maint)
                    ? $maint->vehicle->vehicleData->make . '' . $maint->vehicle->vehicleData->model . ' - ' . $maint->vehicle->license_plate
                    : '';
                })
                ->addColumn('parts_id', function ($maint) {
                    return ($maint->parts)
                    ? $maint->parts->title . '<br/><strong>Vendor: </strong>' . $maint->parts->vendor->name
                    : '';
                })
                ->addColumn('action', function ($maint) {
                    return view('maintenance.list-actions', ['row' => $maint]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'check', 'parts_id'])
                ->make(true);
            //return datatables(User::all())->toJson();

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $vehicle = VehicleData::all();
        $vehicles = VehicleModel::with('vehicleData')->get();
        $parts = PartsModel::with(['vendor', 'category'])->orderBy('id', 'desc')->get();
        return view("maintenance.create", compact('vehicles', 'parts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $part_id = $request->get("parts_id");
        $qty = $request->get("quantity");
        $maintenance = CorrectiveMaintenance::create([
            'vehicle_id' => $request->get("vehicle_id"),
            'subject' => $request->get("subject"),
            'parts_id' => $request->get("parts_id"),
            'meter' => $request->get("meter"),
            'quantity' => $request->get("quantity"),
            'price' => $request->get("price"),
            'description' => $request->get("description") ?? 'N/A',
            'date' => $request->get('date'),
            'deleted_at' => null,
        ]);
        $file = $request->file('files');
        if ($file && $file->isValid()) {
            $destinationPath = './uploads'; // upload path
            $extension = $file->getClientOriginalExtension();

            $fileName1 = Str::uuid() . '.' . $extension;

            $file->move($destinationPath, $fileName1);

            $maintenance->files = $fileName1;
        }
        $maintenance->save();

        $update_part = PartsModel::find($part_id);
        $update_part->stock = $update_part->stock - $qty;
        $update_part->save();
        if ($update_part->stock == 0) {
            $update_part->availability = 0;
            $update_part->save();
        }

        return redirect()->route('maintenance.index');
    }

    public function get_unit_cost($id)
    {
        $part = PartsModel::find($id);
        return response()->json($part->unit_cost);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicles = VehicleModel::all();
        $maintenance = CorrectiveMaintenance::with('vehicle')->find($id);

        return view('maintenance.edit', compact('vehicles', 'maintenance'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $maintenance = CorrectiveMaintenance::with('vehicle')->find($id);

        // Update other shift attributes...
        $maintenance->update([
            'vehicle_id' => $request->get("vehicle_id"),
            'subject' => $request->get("subject"),
            'description' => $request->get("description") ?? 'N/A',
            'date' => $request->get('date'),
            'deleted_at' => null,
        ]);
        $file = $request->file('files');
        if ($file && $file->isValid()) {
            $destinationPath = './uploads'; // upload path
            $extension = $file->getClientOriginalExtension();

            $fileName1 = Str::uuid() . '.' . $extension;

            $file->move($destinationPath, $fileName1);

            $maintenance->files = $fileName1;
        }
        $maintenance->save();

        return redirect()->route('maintenance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

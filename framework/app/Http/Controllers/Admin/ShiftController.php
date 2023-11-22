<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Site;
use App\Model\ProductYield;
use App\Model\Shift;
use App\Model\TimeSlot;
use App\Model\User;
use App\Http\Requests\ShiftRequest;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::with(['timeSlots', 'incharge'])->select('*')->get();
        return view("shifts.index", compact('shifts'));

    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $user = Auth::user();
                $shifts = Shift::select('shifts.*')->with(['timeSlots', 'site', 'incharge']);

            return DataTables::eloquent($shifts)
                ->addColumn('check', function ($product) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $product->id . '" class="checkbox" id="chk' . $product->id . '" onclick=\'checkcheckbox();\'>';
                    return $tag;
                })
                ->editColumn('id', function ($product) {
                    return $product->id;
                })
                ->addColumn('site_name', function ($product) {
                    return ($product->site) ? $product->site->site_name : '';
                })
                ->addColumn('shift_name', function ($product) {
                    return ($product->site) ? $product->shift_name : '';
                })
                ->editColumn('shift_details', function ($product) {
                    return $product->shift_details ? $product->shift_details : '';
                })
                ->addColumn('shift_incharge_id', function ($product) {
                    return ($product->incharge->name) ? $product->incharge->name : '';
                })
                ->addColumn('action', function ($vehicle) {
                    return view('shifts.list-actions', ['row' => $vehicle]);
                })
                ->addIndexColumn()
                ->rawColumns(['time', 'action', 'check'])
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
        $sites = Site::all();
        $users = User::where('group_id', 4)
            ->where('user_type', 'SI')
            ->get();
        return view("shifts.create", compact('users', 'sites'));
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

        $shift = Shift::create([
            'site_id' => $request->get("site_id"),
            'shift_name' => $request->get("shift_name"),
            'shift_incharge_id' => $request->get('shift_incharge_id'),
            'shift_details' => $request->get('shift_details'),
            'deleted_at' => null,
            'status' => '0',
        ]);

        // $startTimes = $request->input('starttimes');
        // $endTimes = $request->input('endtimes');

        // // Loop through the start and end times and create new TimeSlot records
        // for ($i = 0; $i < count($startTimes); $i++) {
        //     $timeSlot = new TimeSlot;
        //     $timeSlot->start_time = $startTimes[$i];
        //     $timeSlot->end_time = $endTimes[$i];
        //     $timeSlot->shift_id = $shift->id; // Associate the time slot with the shift
        //     $timeSlot->save();
        // }

        return redirect()->route('shifts.index');
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
        $sites = Site::all();
        $shifts = Shift::with(['timeSlots', 'incharge'])->find($id);
        $users = User::where('group_id', 4)
            ->where('user_type', 'SI')
            ->get();

        return view('shifts.edit', compact('users', 'sites', 'shifts'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        // Validate request...

        // Update other shift attributes...
        $shift->update([
            'site_id' => $request->get("site_id"),
            'shift_name' => $request->get("shift_name"),
            'shift_incharge_id' => $request->get('shift_incharge_id'),
            'shift_details' => $request->get('shift_details'),
            'deleted_at' => null,
            'status' => '0',
        ]);

        return redirect()->route('shifts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shift::find($id);
        $shift->delete();

        return redirect()->route('shifts.index');
    }
}

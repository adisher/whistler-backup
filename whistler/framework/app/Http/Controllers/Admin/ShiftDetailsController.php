<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Shift;
use App\Model\ShiftDetails;
use App\Model\Site;
use App\Model\User;
use App\Model\WorkOrders;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShiftDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::all();
        return view("shift_details.index", compact('shifts'));

    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $user = Auth::user();
            $shifts = ShiftDetails::select('shift_details.*')->with(['site', 'shift']);

            return DataTables::eloquent($shifts)
                ->addColumn('check', function ($product) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $product->id . '" class="checkbox" id="chk' . $product->id . '" onclick=\'checkcheckbox();\'>';
                    return $tag;
                })
                ->addColumn('site_name', function ($product) {
                    return ($product->site) ? $product->site->site_name : '';
                })
                ->addColumn('shift_name', function ($product) {
                    return ($product->shift) ? $product->shift->shift_name : '';
                })
                ->addColumn('shift_yield_details', function ($product) {
                    return ($product->shift_yield_details) ? $product->shift_yield_details : 'N/A';
                })
                ->addColumn('action', function ($vehicle) {
                    return view('shift_details.list-actions', ['row' => $vehicle]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'check'])
                ->make(true);
            //return datatables(User::all())->toJson();

        }
    }

    public function get_open_shift($site_id)
    {
        $shifts = WorkOrders::where('site_id', $site_id)
            ->whereNull('end_meter')
            ->where('work_hours', 0)
            ->pluck('shift_id');

        return response()->json($shifts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::all();
        // $sites = WorkOrders::with('sites')->where('end_meter', null)->where('work_hours', 0)->get();

        $users = User::where('group_id', 4)
            ->where('user_type', 'SI')
            ->get();
        return view("shift_details.create", compact('users', 'sites'));
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

        $shift = ShiftDetails::create([
            'site_id' => $request->get("site_id"),
            'shift_id' => $request->get("shift_id"),
            'vehicle_id' => $request->get("vehicle_id"),
            'date' => $request->get("date"),
            'work_hours' => $request->get("work_hours") ?? 0,
            'wastage' => $request->get("wastage"),
            'shift_yield_details' => $request->get("shift_yield_details") ? $request->get("shift_yield_details") : '',
            'shift_quantity_grams' => $request->get('shift_quantity_grams'),
            'daily_quantity_grams' => $request->get('shift_quantity_grams'),
            'shift_quantity_pounds' => $request->get('shift_quantity_pounds'),
            'daily_quantity_pounds' => $request->get('shift_quantity_pounds'),
            'yield_quality' => $request->get('yield_quality'),
            'net_weight_grams' => $request->get('net_weight_grams'),
            'net_weight_pounds' => $request->get('net_weight_pounds'),
            'deleted_at' => null,
            'status' => '0',
        ]);

        // // After saving the new shift, get all shifts with the same date
        // $sameDayShifts = ShiftDetails::whereDate('created_at', $shift->created_at)
        //     ->whereIn('shift_name', ['morning', 'evening'])
        //     ->get();

        // // Calculate the sum of shift quantities for these shifts
        // $totalGrams = $sameDayShifts->sum('shift_quantity_grams');
        // $totalPounds = $sameDayShifts->sum('shift_quantity_pounds');

        // // Update the daily quantities for these shifts
        // foreach ($sameDayShifts as $sameDayShift) {
        //     $sameDayShift->update([
        //         'daily_quantity_grams' => $totalGrams,
        //         'daily_quantity_pounds' => $totalPounds,
        //     ]);
        // }

        $filesAsString = "";
        $yieldImages = [];
        $site = Site::find($request->get("site_id")); // Fetch the Site model with the given id
        $siteName = $site->site_name; // Get the site name from the fetched model

        if ($request->hasFile('yield_images')) {
            $files = $request->file('yield_images');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $currentYear = date('Y'); // Fetch the current year
                    $currentMonth = date('m'); // Fetch the current month
                    $siteName = $site->site_name; // Fetch the associated site name
                    $shiftName = '';
                    if ($shift->shift_id == '1') {
                        $shiftName = 'morning'; // Fetch the shift name
                    } else {
                        $shiftName = 'evening'; // Fetch the shift name
                    }

                    // Clean up names for folder use (remove unwanted characters and spaces)
                    $cleanSiteName = preg_replace("/[^A-Za-z0-9 ]/", '', $siteName);
                    $cleanShiftName = preg_replace("/[^A-Za-z0-9 ]/", '', $shiftName);

                    $imageName = time() . '-' . $file->getClientOriginalName();

                    // Create nested directories
                    $fullFilePath = 'public/uploads/' . $cleanSiteName . '/' . $cleanShiftName . '/' . $currentYear . '/' . $currentMonth;
                    $file->storeAs($fullFilePath, $imageName);

                    $yieldImages[] = $fullFilePath . '/' . $imageName;
                } else {
                    // File did not pass validation rules
                }
            }
            // $filesAsString = implode(",", $yieldImages);
            $filesAsString = json_encode($yieldImages);

            // Now update the shift with the saved file paths
            $shift->update(['files' => $filesAsString]);
        }

        return redirect()->route('shift-details.index');

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
        $shifts = ShiftDetails::select('shift_details.*')->with(['site']);
        $shift_details = ShiftDetails::find($id);
        $users = User::where('group_id', 4)
            ->where('user_type', 'SI')
            ->get();

        return view('shift_details.edit', compact('users', 'sites', 'shifts', 'shift_details'));

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
        // Validate request...

        $shift = ShiftDetails::find($id);
        // Update other shift attributes...
        $shift->update([
            'site_id' => $request->get("site_id"),
            'shift_id' => $request->get("shift_id"),
            'date' => $request->get("date"),
            'work_hours' => $request->get("work_hours"),
            'wastage' => $request->get("wastage"),
            'shift_yield_details' => $request->get("shift_yield_details") ? $request->get("shift_yield_details") : '',
            'shift_quantity_grams' => $request->get('shift_quantity_grams'),
            'daily_quantity_grams' => $request->get('shift_quantity_grams'),
            'shift_quantity_pounds' => $request->get('shift_quantity_pounds'),
            'daily_quantity_pounds' => $request->get('shift_quantity_pounds'),
            'yield_quality' => $request->get('yield_quality'),
            'net_weight_grams' => $request->get('net_weight_grams'),
            'net_weight_pounds' => $request->get('net_weight_pounds'),
            'deleted_at' => null,
            'status' => '0',
        ]);

        $yieldImages = [];
        $site = Site::find($request->get("site_id")); // Fetch the Site model with the given id
        $siteName = $site->site_name; // Get the site name from the fetched model
        if ($request->hasFile('yield_images')) {
            $files = $request->file('yield_images');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $currentYear = date('Y'); // Fetch the current year
                    $currentMonth = date('m'); // Fetch the current month
                    $siteName = $site->site_name; // Fetch the associated site name
                    $shiftName = 'shift-' . $shift->id; // Fetch the shift name using shift id
                    $shiftName = '';
                    if ($shift->shift_id == '1') {
                        $shiftName = 'morning'; // Fetch the shift name
                    } else {
                        $shiftName = 'evening'; // Fetch the shift name
                    }

                    // Clean up names for folder use (remove unwanted characters and spaces)
                    $cleanSiteName = preg_replace("/[^A-Za-z0-9 ]/", '', $siteName);
                    $cleanShiftName = preg_replace("/[^A-Za-z0-9 ]/", '', $shiftName);

                    $imageName = time() . '-' . $file->getClientOriginalName();

                    // Create nested directories
                    $fullFilePath = 'public/uploads/' . $cleanSiteName . '/' . $cleanShiftName . '/' . $currentYear . '/' . $currentMonth;
                    $file->storeAs($fullFilePath, $imageName);

                    $yieldImages[] = $fullFilePath . '/' . $imageName;
                } else {
                    // File did not pass validation rules
                }
            }

            // Convert the array to a JSON string
            $filesAsString = json_encode($yieldImages);

            // Update the shift with the new file paths
            $shift->update(['files' => $filesAsString]);

            $oldImagePaths = json_decode($shift->files, true);
            // Delete old images not in the new paths list
            foreach ($oldImagePaths as $oldImagePath) {
                if (!in_array($oldImagePath, $yieldImages) && Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        }

        return redirect()->route('shift-details.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = ShiftDetails::find($id);
        if ($shift->files !== null) {
            $oldImagePaths = json_decode($shift->files, true);
            // Delete old images not in the new paths list
            foreach ($oldImagePaths as $oldImagePath) {
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        }
        $shift->delete();

        return redirect()->route('shift-details.index');
    }
}

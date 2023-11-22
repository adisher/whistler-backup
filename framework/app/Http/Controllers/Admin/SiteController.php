<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Shift;
use App\Model\Site;
use App\Model\User;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['role:Admin']);
        $this->middleware('permission:ProductYields list');
        $this->middleware('permission:ProductYields add');
        $this->middleware('permission:ProductYields edit');
        $this->middleware('permission:ProductYields delete');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Site::all();
        return view("sites.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('group_id', 4)
            ->where('user_type', 'SI')
            ->get();
        return view("sites.create", compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get("site_name") && $request->get("site_details")) {
            $site = Site::create([
                'site_name' => $request->get("site_name"),
                'site_details' => $request->get("site_details"),
                'product_transfer' => $request->get("product_transfer") ?? 0,
                'deleted_at' => null,
                'status' => '1',
            ]);

            $shifts = ['morning', 'evening'];
            $incharge = Auth::user()->id;
            $date = date('Y-m-d');

            foreach ($shifts as $shift_name) {
                Shift::create([
                    'site_id' => $site->id,
                    'shift_name' => $shift_name,
                    'shift_details' => 'Shift Details',
                    'date' => $date,
                    'shift_incharge_id' => $incharge,
                    'deleted_at' => null,
                    'status' => '1',
                ]);
            }

            return redirect()->route('sites.index');
        }

    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {

            $user = Auth::user();
            $products = Site::select('sites.*');

            return DataTables::eloquent($products)
                ->addColumn('check', function ($product) {
                    $tag = '<input type="checkbox" name="ids[]" value="' . $product->id . '" class="checkbox" id="chk' . $product->id . '" onclick=\'checkcheckbox();\'>';

                    return $tag;
                })
                ->addColumn('site_name', function ($product) {
                    return ($product->site_name) ? $product->site_name : '';
                })
                ->addColumn('site_details', function ($product) {
                    return ($product->site_details) ? $product->site_details : '';
                })
            // ->addColumn('site_production_details', function ($product) {
            //     return ($product->site_production_details) ? $product->site_production_details : '';
            // })
            // ->addColumn('stock_details', function ($product) {
            //     return ($product->stock_details) ? $product->stock_details : '';
            // })
                ->addColumn('product_transfer', function ($vehicle) {
                    return ($vehicle->product_transfer) ? "YES" : "NO";
                })
                ->addColumn('status', function ($vehicle) {
                    return ($vehicle->status) ? "Approved" : "Not Approved";
                })
                ->addColumn('action', function ($vehicle) {
                    return view('sites.list-actions', ['row' => $vehicle]);
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'check'])
                ->make(true);
            //return datatables(User::all())->toJson();

        }
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
        $products = Site::findOrFail($id);
        $users = User::where('group_id', 4)
            ->where('user_type', 'SI')
            ->get();

        return view('sites.edit', compact(['users', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        $productYield = Site::find($id);

        $productYield->status = true;
        $productYield->save();

        return redirect()->back()->with('success', 'Site has been approved.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product_yield = Site::find($request->get('id'));
        // Assign request data to model properties
        $product_yield->site_name = $request->get("site_name");
        $product_yield->site_details = $request->get("site_details");
        $product_yield->product_transfer = $request->get("product_transfer") ?? 0;
        $product_yield->status = '1';

        $product_yield->save();

        // Save and check if the save operation was successful
        if ($product_yield->save()) {
            return redirect()->route('sites.index');
        } else {
            // Add your error handling here, e.g., log the error or return an error response
            return back()->with('error', 'Update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yield = Site::findOrFail($id);

        // Get the names of the images from the database
        $images = explode(',', $yield->files);

        // Delete the images from the uploads directory
        foreach ($images as $image) {
            if (Storage::disk('public')->exists('uploads/' . $image)) {
                Storage::disk('public')->delete('uploads/' . $image);
            }
        }

        // Remove the images from the database
        $yield->files = null;
        $yield->save();

        // Delete the vehicle record
        $yield->delete();

        return redirect()->route('sites.index')
            ->with('success', 'Deleted successfully.');

    }
}

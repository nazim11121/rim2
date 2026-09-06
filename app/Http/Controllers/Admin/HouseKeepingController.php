<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\HouseKeeping;
use App\Models\Admin\Amenities;
use App\Models\Admin\Room;
use App\Models\Admin\Vendor;
use Illuminate\Http\Request;
use Auth;

class HouseKeepingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  HouseKeeping::latest()->get();

        return view('admin.houseKeeping.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomList = Room::where('status', 1)->get();
        $amenitiesList = Amenities::where('status', 1)->get();
        $vendorList = Vendor::where('status', 1)->get();

        return view('admin.houseKeeping.create',compact(['roomList','amenitiesList','vendorList']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amenities_id' => 'required',
            'room_no' => 'required',
            'vendor_id' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('house-keeping/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['created_by'] = Auth::id();
        $validatedData['amenities_id'] = json_encode($request->amenities_id);
        $dataStore = HouseKeeping::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.house-keeping.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.house-keeping.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(HouseKeeping $houseKeeping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = HouseKeeping::find($id);
        $amenitiesList = Amenities::where('status', 1)->get();
        $vendorList = Vendor::where('status', 1)->get();
        $roomList = Room::where('status', 1)->get();
        $selectedItems = json_decode($data->amenities_id, true);

        return view('admin.houseKeeping.edit',compact(['data','amenitiesList','vendorList','roomList','selectedItems']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amenities_id' => 'required',
            'room_no' => 'required',
            'vendor_id' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('house-keeping/type/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = HouseKeeping::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.house-keeping.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.house-keeping.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = HouseKeeping::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.house-keeping.index')->with('success', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.house-keeping.index')->with('error', 'Data Delete Failed.');
        }
    }
}

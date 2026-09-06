<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Amenities;
use App\Models\Admin\RoomType;
use Illuminate\Http\Request;
use Auth;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  RoomType::latest()->get();

        return view('admin.roomType.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenitiesList = Amenities::where('status', 1)->get();
        return view('admin.roomType.create', compact('amenitiesList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:room_types|max:60',
            'type' => 'required',
            'short_code' => 'nullable',
            'adult_capacity' => 'required',
            'kids_capacity' => 'nullable',
            'base_price' => 'required',
            'priority' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('rooms/type/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/roomType'), $fileName);
            $filePath = 'uploads/roomType/' .$fileName;
        }else{
            $filePath = NULL;
        }

        $validatedData = $validator->validated();
        $validatedData['amenities'] = json_encode($request->amenities);
        $validatedData['image'] = $filePath;
        $validatedData['created_by'] = Auth::id();
        $dataStore = RoomType::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.type.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.type.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = RoomType::find($id);
        $amenitiesList = Amenities::where('status', 1)->get();

        return view('admin.roomType.edit',compact(['data','amenitiesList']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomType $roomType, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60',
            'type' => 'required',
            'short_code' => 'nullable',
            'adult_capacity' => 'required',
            'kids_capacity' => 'nullable',
            'base_price' => 'required',
            'priority' => 'nullable',
            'amenities_list' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ]);
       
        if ($validator->fails()) {
            return redirect('rooms/type/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
   
        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/roomType'), $fileName);
            $filePath = 'uploads/roomType/' .$fileName;
        }else{
            $filePath = RoomType::find($id)->image;
        }

        // $validatedData = $validator->validated();
        $validatedData['amenities'] = json_encode($request->amenities_list);
        $validatedData['image'] = $filePath;
        $validatedData['updated_by'] = Auth::id();
        $dataUpdate = RoomType::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.type.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.type.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType, $id)
    {
        $data = RoomType::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.type.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.type.index')->with('error', 'Data Delete Failed.');
        }
    }
}

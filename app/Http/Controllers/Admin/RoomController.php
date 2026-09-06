<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Room;
use App\Models\Admin\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Room::latest()->get();

        return view('admin.room.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomTypeList =  RoomType::where('status', 1)->latest()->get();
        return view('admin.room.create',compact('roomTypeList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:rooms|max:60',
            'type' => 'required',
            'room_no' => 'required',
            'floor' => 'required',
            'priority' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('room/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/room'), $fileName);
            $filePath = 'uploads/room/' .$fileName;
        }else{
            $filePath = NULL;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['created_by'] = Auth::id();
        $dataStore = Room::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.room.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.room.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Room::find($id);
        $roomTypeList =  RoomType::where('status', 1)->latest()->get();

        return view('admin.room.edit',compact(['data','roomTypeList']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60',
            'type' => 'required',
            'room_no' => 'required',
            'floor' => 'required',
            'priority' => 'nullable',
            'description' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('room/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/room'), $fileName);
            $filePath = 'uploads/room/' .$fileName;
        }else{
            $filePath = Room::find($id)->image;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Room::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.room.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.room.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { 
        $data = Room::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.room.index')->with('success', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.room.index')->with('error', 'Data Delete Failed.');
        }
    }
}

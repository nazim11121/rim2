<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Amenities;
use Illuminate\Http\Request;
use Auth;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Amenities::latest()->get();

        return view('admin.amenities.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.amenities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:amenities|max:60',
            'description' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('room/amenities/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['created_by'] = Auth::id();
        $dataStore = Amenities::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.amenities.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.amenities.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Amenities $amenities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Amenities::find($id);

        return view('admin.amenities.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Amenities $amenities, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:amenities|max:60',
            'description' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('room/amenities/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Amenities::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.amenities.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.amenities.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenities $amenities, $id)
    {
        $data = Amenities::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.amenities.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.amenities.index')->with('error', 'Data Delete Failed.');
        }
    }
}

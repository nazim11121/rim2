<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Vendor;
use Illuminate\Http\Request;
use Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Vendor::latest()->get();

        return view('admin.vendor.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'nid_no' => 'nullable',
            'gender' => 'nullable',
            'address' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('vendors/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $profile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents'), $profile);
            $imagePath = 'uploads/documents/' .$profile;
        }else{
            $imagePath = NULL;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $imagePath;
        $validatedData['created_by'] = Auth::id();
        $dataStore = Vendor::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.vendors.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.vendors.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Vendor::find($id);

        return view('admin.vendor.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'nid_no' => 'nullable',
            'gender' => 'nullable',
            'address' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('vendors/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $profile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents'), $profile);
            $imagePath = 'uploads/documents/' .$profile;
        }else{
            $imagePath = Vendor::where('id', $id)->first()->image;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $imagePath;
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Vendor::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.vendors.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.vendors.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Vendor::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.vendors.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.vendors.index')->with('error', 'Data Delete Failed.');
        }
    }
}

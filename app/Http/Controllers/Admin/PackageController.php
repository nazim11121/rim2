<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Package;
use App\Models\Admin\PackageCategory;
use Illuminate\Http\Request;
use Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Package::latest()->get();

        return view('admin.packages.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PackageCategory::where('status', 1)->get();
        return view('admin.packages.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:packages|max:60',
            'category_id' => 'required',  //|exists:categories,id',
            'no_of_day' => 'required|numeric',
            'no_of_person' => 'required|numeric',
            'price' => 'required|numeric',
            'price_for' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('packages/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/packages'), $fileName);
            $filePath = 'uploads/packages/' .$fileName;
        }else{
            $filePath = NULL;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['created_by'] = Auth::id();
        $dataStore = Package::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.package.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.package.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Package::find($id);
        $categories = PackageCategory::where('status', 1)->get();
        return view('admin.packages.edit',compact(['data', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60',
            'category_id' => 'required',  //|exists:categories,id',
            'no_of_day' => 'required|numeric',
            'no_of_person' => 'required|numeric',
            'price' => 'required|numeric',
            'price_for' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('packages/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/packages'), $fileName);
            $filePath = 'uploads/packages/' .$fileName;
        }else{
            $filePath = Package::find($id)->image;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Package::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.package.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.package.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Package::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.package.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.package.index')->with('error', 'Data Delete Failed.');
        }
    }
}

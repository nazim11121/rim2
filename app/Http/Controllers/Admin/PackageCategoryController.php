<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\PackageCategory;
use Illuminate\Http\Request;
use Auth;

class PackageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  PackageCategory::latest()->get();

        return view('admin.packages.category.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:package_categories|max:60',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('package_categories/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['created_by'] = Auth::id();
        $dataStore = PackageCategory::create($validatedData);

        if($dataStore){
            return redirect()->route('package-category.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('package-category.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = PackageCategory::find($id);

        return view('admin.packages.category.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { 
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('package_categories/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = PackageCategory::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('package-category.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('package-category.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = PackageCategory::find($id);
        $data->delete();

        if($data){
            return redirect()->route('package-category.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('package-category.index')->with('error', 'Data Delete Failed.');
        }
    }
}

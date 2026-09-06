<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Frontend\AboutUs;
use Illuminate\Http\Request;
use Auth;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  AboutUs::latest()->get()->first();

        return view('admin.aboutUs.create',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.aboutUs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'tag1' => 'nullable',
            'tag2' => 'nullable',
            'tag3' => 'nullable',
            'image' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('frontend/aboutUs/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/aboutUs'), $fileName);
            $filePath = 'uploads/aboutUs/' .$fileName;
        }else{
            $filePath = NULL;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['created_by'] = Auth::id();
        $dataStore = AboutUs::create($validatedData);

        if($dataStore){
            return redirect()->route('aboutUs.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('aboutUs.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = AboutUs::find($id);

        return view('admin.aboutUs.edit',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'tag1' => 'nullable',
            'tag2' => 'nullable',
            'tag3' => 'nullable',
            'image' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('frontend/aboutUs/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/aboutUs'), $fileName);
            $filePath = 'uploads/aboutUs/' .$fileName;
        }else{
            $filePath = AboutUs::find($id)->image;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['updated_by'] = Auth::id();
        $dataUpdate = aboutUs::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('aboutUs.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('aboutUs.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = AboutUs::find($id);
        $data->delete();

        if($data){
            return redirect()->route('aboutUs.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('aboutUs.index')->with('error', 'Data Delete Failed.');
        }
    }
}

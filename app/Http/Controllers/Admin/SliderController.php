<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Slider;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Slider::orderBy('hierarchy', 'ASC')->get();

        return view('admin.slider.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'hierarchy' => 'nullable|integer',
            'remarks' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        // try{
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }

            if ($request->hasFile('image')) {
                $image      = $request->file('image');
                $imageName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/slider'), $imageName);
                $imagePath = 'uploads/slider/' . $imageName;

            }else{
                $imagePath = null;
            }
       
            $data = New Slider();
            $data->name = $request->name;
            $data->hierarchy = $request->hierarchy;
            $data->image = $imagePath;
            $data->remarks = $request->remarks;
            $data->status = $status;
            $data->created_by = Auth::id();
            $data->save();

            return redirect()->route('admin.slider.index')->with('success','Data Save Successfully');
        // } catch (QueryException $e) {
        //     return redirect()->back()->with('error', 'Database error: Unable to submit data.');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'An unexpected error occurred.');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Slider::find($id);
        return view('admin.slider.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'hierarchy' => 'nullable|integer',
            'remarks' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try{
            if($request->status){
                $status = $request->status;
            }else{
                $status = 0;
            }

            
            if ($request->hasFile('image')) {
                $image      = $request->file('image');
                $imageName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/slider'), $imageName);
                $imagePath = 'uploads/slider/' . $imageName;
            }else{
                $imagePath = null;
            }

            $data = Slider::find($id);
            $data->name = $request->name;
            $data->hierarchy = $request->hierarchy;
            $data->image = $imagePath ? $imagePath : $data->image;
            $data->remarks = $request->remarks;
            $data->status = $status;
            $data->save();

            return redirect()->route('admin.slider.index')->with('info','Data Updated Successfully');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error: Unable to update data.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = Slider::find($id);
            $data->delete();

            return redirect()->route('admin.slider.index')->with('warning','Data Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to delete the user.');
        }
    }
}

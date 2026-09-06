<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Menu::latest()->get();

        return view('admin.menu.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create',compact('allData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:menus|max:60',
            'priority' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('frontend/menu/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $dataStore = Menu::create($validator);

        if($dataStore){
            return redirect()->route('menu.index')->with('success', 'Data Store Successfull.');
        }else{
            return redirect()->route('menu.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Menu::find($id);

        return view('admin.menu.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:menus|max:60',
            'priority' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('frontend/menu/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $dataStore = Menu::update($validator);

        if($dataStore){
            return redirect()->route('menu.index')->with('info', 'Data Updated Successfull.');
        }else{
            return redirect()->route('menu.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $data = Menu::find($id);
        $data->delete();

        if($dataStore){
            return redirect()->route('menu.index')->with('danger', 'Data Deleted Successfull.');
        }else{
            return redirect()->route('menu.index')->with('error', 'Data Delete Failed.');
        }
    }
}

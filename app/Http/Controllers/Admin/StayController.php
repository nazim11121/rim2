<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Stay;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StayController extends Controller
{
    public function index()
    {
        $allData = Stay::orderBy('sort_order')->get();

        return view('admin.stays.index', compact('allData'));
    }

    public function create()
    {
        return view('admin.stays.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug'             => 'required|alpha_dash|unique:stays,slug|max:60',
            'name'             => 'required|max:100',
            'meaning'          => 'nullable|max:191',
            'description'      => 'nullable',
            'min_guests'       => 'required|integer|min:1',
            'max_guests'       => 'required|integer|min:1',
            'pricing_mode'     => 'required|in:per_person_occupancy,per_person_group',
            'whole_unit_only'  => 'nullable',
            'hero_image'       => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:4096',
            'sort_order'       => 'nullable|integer',
            'is_published'     => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('stays/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();

        if ($request->file('hero_image')) {
            $file = $request->file('hero_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/stays'), $fileName);
            $validatedData['hero_image'] = 'uploads/stays/' . $fileName;
        }

        $validatedData['whole_unit_only'] = $request->boolean('whole_unit_only');
        $validatedData['is_published'] = $request->boolean('is_published');
        $validatedData['created_by'] = Auth::id();

        $dataStore = Stay::create($validatedData);

        if ($dataStore) {
            return redirect()->route('admin.stays.index')->with('success', 'Data Store Successful.');
        } else {
            return redirect()->route('admin.stays.create')->with('error', 'Data Store Failed.');
        }
    }

    public function show(Stay $stay)
    {
        //
    }

    public function edit($id)
    {
        $data = Stay::with('rateTiers')->findOrFail($id);

        return view('admin.stays.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $stay = Stay::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'slug'             => 'required|alpha_dash|max:60|unique:stays,slug,' . $stay->id,
            'name'             => 'required|max:100',
            'meaning'          => 'nullable|max:191',
            'description'      => 'nullable',
            'min_guests'       => 'required|integer|min:1',
            'max_guests'       => 'required|integer|min:1',
            'pricing_mode'     => 'required|in:per_person_occupancy,per_person_group',
            'whole_unit_only'  => 'nullable',
            'hero_image'       => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:4096',
            'sort_order'       => 'nullable|integer',
            'is_published'     => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('stays/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();

        if ($request->file('hero_image')) {
            $file = $request->file('hero_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/stays'), $fileName);
            $validatedData['hero_image'] = 'uploads/stays/' . $fileName;
        } else {
            $validatedData['hero_image'] = $stay->hero_image;
        }

        $validatedData['whole_unit_only'] = $request->boolean('whole_unit_only');
        $validatedData['is_published'] = $request->boolean('is_published');
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = $stay->update($validatedData);

        if ($dataUpdate) {
            return redirect()->route('admin.stays.edit', $id)->with('info', 'Data Updated Successful.');
        } else {
            return redirect()->route('admin.stays.edit', $id)->with('error', 'Data Update Failed.');
        }
    }

    public function destroy($id)
    {
        $data = Stay::find($id);
        $data->delete();

        if ($data) {
            return redirect()->route('admin.stays.index')->with('danger', 'Data Deleted Successful.');
        } else {
            return redirect()->route('admin.stays.index')->with('error', 'Data Delete Failed.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Gallery;
use Illuminate\Http\Request;
use Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $allData = Gallery::latest()->get();

        return view('admin.gallery.index', compact('allData'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|max:191',
            'category' => 'nullable|max:100',
            'caption' => 'nullable',
            'priority' => 'nullable|numeric',
            'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:4096',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('gallery/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/gallery'), $fileName);

        $validatedData = $validator->validated();
        $validatedData['image'] = 'uploads/gallery/' . $fileName;
        $validatedData['created_by'] = Auth::id();
        $dataStore = Gallery::create($validatedData);

        if ($dataStore) {
            return redirect()->route('admin.gallery.index')->with('success', 'Data Store Successful.');
        } else {
            return redirect()->route('admin.gallery.create')->with('error', 'Data Store Failed.');
        }
    }

    public function show(Gallery $gallery)
    {
        //
    }

    public function edit($id)
    {
        $data = Gallery::find($id);

        return view('admin.gallery.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|max:191',
            'category' => 'nullable|max:100',
            'caption' => 'nullable',
            'priority' => 'nullable|numeric',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:4096',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('gallery/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $fileName);
            $filePath = 'uploads/gallery/' . $fileName;
        } else {
            $filePath = Gallery::find($id)->image;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Gallery::where('id', $id)->update($validatedData);

        if ($dataUpdate) {
            return redirect()->route('admin.gallery.index')->with('info', 'Data Updated Successful.');
        } else {
            return redirect()->route('admin.gallery.edit')->with('error', 'Data Update Failed.');
        }
    }

    public function destroy($id)
    {
        $data = Gallery::find($id);
        $data->delete();

        if ($data) {
            return redirect()->route('admin.gallery.index')->with('danger', 'Data Deleted Successful.');
        } else {
            return redirect()->route('admin.gallery.index')->with('error', 'Data Delete Failed.');
        }
    }
}

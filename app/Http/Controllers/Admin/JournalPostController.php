<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\JournalPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class JournalPostController extends Controller
{
    public function index()
    {
        $allData = JournalPost::latest()->get();

        return view('admin.journal.index', compact('allData'));
    }

    public function create()
    {
        return view('admin.journal.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'category' => 'nullable|max:100',
            'author' => 'nullable|max:100',
            'published_at' => 'nullable|date',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:4096',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('journal/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/journal'), $fileName);
            $filePath = 'uploads/journal/' . $fileName;
        } else {
            $filePath = null;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['slug'] = Str::slug($validatedData['title']) . '-' . time();
        $validatedData['created_by'] = Auth::id();
        $dataStore = JournalPost::create($validatedData);

        if ($dataStore) {
            return redirect()->route('admin.journal.index')->with('success', 'Data Store Successful.');
        } else {
            return redirect()->route('admin.journal.create')->with('error', 'Data Store Failed.');
        }
    }

    public function show(JournalPost $journalPost)
    {
        //
    }

    public function edit($id)
    {
        $data = JournalPost::find($id);

        return view('admin.journal.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'category' => 'nullable|max:100',
            'author' => 'nullable|max:100',
            'published_at' => 'nullable|date',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:4096',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('journal/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/journal'), $fileName);
            $filePath = 'uploads/journal/' . $fileName;
        } else {
            $filePath = JournalPost::find($id)->image;
        }

        $validatedData = $validator->validated();
        $validatedData['image'] = $filePath;
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = JournalPost::where('id', $id)->update($validatedData);

        if ($dataUpdate) {
            return redirect()->route('admin.journal.index')->with('info', 'Data Updated Successful.');
        } else {
            return redirect()->route('admin.journal.edit')->with('error', 'Data Update Failed.');
        }
    }

    public function destroy($id)
    {
        $data = JournalPost::find($id);
        $data->delete();

        if ($data) {
            return redirect()->route('admin.journal.index')->with('danger', 'Data Deleted Successful.');
        } else {
            return redirect()->route('admin.journal.index')->with('error', 'Data Delete Failed.');
        }
    }
}

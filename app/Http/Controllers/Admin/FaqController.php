<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Faq;
use Illuminate\Http\Request;
use Auth;

class FaqController extends Controller
{
    public function index()
    {
        $allData = Faq::latest()->get();

        return view('admin.faq.index', compact('allData'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:255',
            'answer' => 'required',
            'category' => 'nullable|max:100',
            'priority' => 'nullable|numeric',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('faq/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['created_by'] = Auth::id();
        $dataStore = Faq::create($validatedData);

        if ($dataStore) {
            return redirect()->route('admin.faq.index')->with('success', 'Data Store Successful.');
        } else {
            return redirect()->route('admin.faq.create')->with('error', 'Data Store Failed.');
        }
    }

    public function show(Faq $faq)
    {
        //
    }

    public function edit($id)
    {
        $data = Faq::find($id);

        return view('admin.faq.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:255',
            'answer' => 'required',
            'category' => 'nullable|max:100',
            'priority' => 'nullable|numeric',
            'status' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('faq/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Faq::where('id', $id)->update($validatedData);

        if ($dataUpdate) {
            return redirect()->route('admin.faq.index')->with('info', 'Data Updated Successful.');
        } else {
            return redirect()->route('admin.faq.edit')->with('error', 'Data Update Failed.');
        }
    }

    public function destroy($id)
    {
        $data = Faq::find($id);
        $data->delete();

        if ($data) {
            return redirect()->route('admin.faq.index')->with('danger', 'Data Deleted Successful.');
        } else {
            return redirect()->route('admin.faq.index')->with('error', 'Data Delete Failed.');
        }
    }
}

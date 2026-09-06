<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Promo;
use App\Models\Admin\Stay;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    public function index()
    {
        $allData = Promo::latest()->get();

        return view('admin.promos.index', compact('allData'));
    }

    public function create()
    {
        $stays = Stay::orderBy('sort_order')->pluck('name', 'slug');

        return view('admin.promos.create', compact('stays'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'                => 'required|max:40|unique:promos,code',
            'type'                => 'required|in:pct,flat',
            'value'               => 'required|numeric|min:0',
            'label'               => 'required|max:191',
            'starts_on'           => 'nullable|date',
            'ends_on'             => 'nullable|date',
            'min_nights'          => 'nullable|integer|min:1',
            'stay_slugs'          => 'nullable|array',
            'max_uses'            => 'nullable|integer|min:1',
            'max_uses_per_email'  => 'nullable|integer|min:1',
            'is_active'           => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('promos/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['code'] = strtoupper(trim($validatedData['code']));
        $validatedData['stay_slugs'] = filled($validatedData['stay_slugs'] ?? null) ? $validatedData['stay_slugs'] : null;
        $validatedData['is_active'] = $request->boolean('is_active');
        $validatedData['created_by'] = Auth::id();

        $dataStore = Promo::create($validatedData);

        if ($dataStore) {
            return redirect()->route('admin.promos.index')->with('success', 'Data Store Successful.');
        } else {
            return redirect()->route('admin.promos.create')->with('error', 'Data Store Failed.');
        }
    }

    public function show(Promo $promo)
    {
        //
    }

    public function edit($id)
    {
        $data = Promo::findOrFail($id);
        $stays = Stay::orderBy('sort_order')->pluck('name', 'slug');

        return view('admin.promos.edit', compact('data', 'stays'));
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'code'                => 'required|max:40|unique:promos,code,' . $promo->id,
            'type'                => 'required|in:pct,flat',
            'value'               => 'required|numeric|min:0',
            'label'               => 'required|max:191',
            'starts_on'           => 'nullable|date',
            'ends_on'             => 'nullable|date',
            'min_nights'          => 'nullable|integer|min:1',
            'stay_slugs'          => 'nullable|array',
            'max_uses'            => 'nullable|integer|min:1',
            'max_uses_per_email'  => 'nullable|integer|min:1',
            'is_active'           => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('promos/' . $id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['code'] = strtoupper(trim($validatedData['code']));
        $validatedData['stay_slugs'] = filled($validatedData['stay_slugs'] ?? null) ? $validatedData['stay_slugs'] : null;
        $validatedData['is_active'] = $request->boolean('is_active');
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = $promo->update($validatedData);

        if ($dataUpdate) {
            return redirect()->route('admin.promos.index')->with('info', 'Data Updated Successful.');
        } else {
            return redirect()->route('admin.promos.edit', $id)->with('error', 'Data Update Failed.');
        }
    }

    public function destroy($id)
    {
        $data = Promo::find($id);
        $data->delete();

        if ($data) {
            return redirect()->route('admin.promos.index')->with('danger', 'Data Deleted Successful.');
        } else {
            return redirect()->route('admin.promos.index')->with('error', 'Data Delete Failed.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\RateTier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/* No index/create/edit/show views: this is a pure helper resource for the
   nested rate-tier manager on the Stay edit page. store()/destroy() always
   redirect back there. */
class RateTierController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stay_id'      => 'required|exists:stays,id',
            'from_guests'  => 'required|integer|min:1',
            'weekday_rate' => 'required|integer|min:0',
            'weekend_rate' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.stays.edit', $request->input('stay_id'))
                        ->withErrors($validator)
                        ->withInput();
        }

        RateTier::updateOrCreate(
            ['stay_id' => $request->input('stay_id'), 'from_guests' => $request->input('from_guests')],
            $validator->validated()
        );

        return redirect()->route('admin.stays.edit', $request->input('stay_id'))->with('success', 'Rate tier saved.');
    }

    public function destroy($id)
    {
        $tier = RateTier::findOrFail($id);
        $stayId = $tier->stay_id;
        $tier->delete();

        return redirect()->route('admin.stays.edit', $stayId)->with('danger', 'Rate tier removed.');
    }
}

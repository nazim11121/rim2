<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;

/* A single-page editor for the key/value settings table, not a list — there is
   no index. holidays is deliberately left out of this simple form (a full date
   picker UI isn't worth it yet); set it via tinker or a seeder for now:
     Setting::put('holidays', ['2026-12-16', ...]); */
class SettingController extends Controller
{
    public function edit()
    {
        $data = [
            'vat_rate'             => Setting::get('vat_rate', 0.15),
            'weekday_discount'     => Setting::get('weekday_discount', 0.15),
            'weekend_days'         => implode(',', Setting::get('weekend_days', [5, 6])),
            'property_max_guests'  => Setting::get('property_max_guests', 20),
        ];

        return view('admin.settings.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'vat_rate'             => 'required|numeric|min:0|max:1',
            'weekday_discount'     => 'required|numeric|min:0|max:1',
            'weekend_days'         => 'required|string',
            'property_max_guests'  => 'required|integer|min:1',
        ]);

        Setting::put('vat_rate', (float) $validated['vat_rate']);
        Setting::put('weekday_discount', (float) $validated['weekday_discount']);
        Setting::put('weekend_days', collect(explode(',', $validated['weekend_days']))
            ->map(fn ($d) => (int) trim($d))
            ->values()
            ->all());
        Setting::put('property_max_guests', (int) $validated['property_max_guests']);

        return redirect()->route('admin.settings.edit')->with('info', 'Settings updated.');
    }
}

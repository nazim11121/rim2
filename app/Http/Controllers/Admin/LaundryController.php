<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Laundry;
use App\Models\Admin\LaundryReceived;
use App\Models\Admin\Amenities;
use App\Models\Admin\Vendor;
use Illuminate\Http\Request;
use Auth;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Laundry::latest()->get();

        return view('admin.laundry.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenitiesList = Amenities::where('status', 1)->get();
        $vendorList = Vendor::where('status', 1)->get();

        return view('admin.laundry.create',compact(['amenitiesList','vendorList']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'amenities_id' => 'required',
            'room_no' => 'nullable',
            'vendor_id' => 'nullable',
            'description' => 'nullable',
            'assign_date' => 'nullable',
            'quantity' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('laundry/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['amenities_id'] = json_encode($request->amenities_id);
        $validatedData['quantity'] = json_encode($request->quantity);
        $validatedData['created_by'] = Auth::id();
        $dataStore = Laundry::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.laundry.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.laundry.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Laundry $laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $laundry = Laundry::find($id);

        $amenitiesList = Amenities::where('status', 1)->get();
        $vendorList = Vendor::where('status', 1)->get();
        $amenities = json_decode($laundry->amenities_id, true); // ["2","3"]
        $quantities = json_decode($laundry->quantity, true);    // ["2","1"]

        foreach ($amenities as $index => $amenityId) {
            $qty = $quantities[$index];
            echo "Amenity ID: $amenityId | Quantity: $qty <br>";
        }

        return view('admin.laundry.edit',compact(['laundry','amenitiesList','vendorList']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amenities_id' => 'required',
            'room_no' => 'nullable',
            'vendor_id' => 'nullable',
            'description' => 'nullable',
            'assign_date' => 'nullable',
            'quantity' => 'nullable',
        ]);
 
        if ($validator->fails()) {
            return redirect('laundry/type/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
         // Find the laundry record
        $laundry = Laundry::findOrFail($id);

        // Save updates
        $laundry->room_no      = $request->room_no;
        $laundry->assign_date  = $request->assign_date;
        $laundry->vendor_id    = $request->vendor_id;
        $laundry->amenities_id = json_encode($request->amenities_id);
        $laundry->quantity     = json_encode($request->quantity);
        $laundry->updated_by   = auth()->id();

        $laundry->save();

        if($laundry){
            return redirect()->route('admin.laundry.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.laundry.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Laundry::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.laundry.index')->with('success', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.laundry.index')->with('error', 'Data Delete Failed.');
        }
    }

    public function receive($id)
    {
        // Fetch the laundry record
        $data = Laundry::find($id);

        // Get active amenities and vendors
        $amenitiesList = Amenities::where('status', 1)->get();
        $vendorList = Vendor::where('status', 1)->get();

        // Decode amenities and quantities from the Laundry model
        $amenities = json_decode($data->amenities_id, true); // ["2", "3"]
        $quantities = json_decode($data->quantity, true);    // ["2", "1"]

        // Fetch received items from the LaundryReceived table
        $receivedItems = LaundryReceived::where('laundry_id', $id)->orderBy('id','ASC')->get();

        // Pre-process received items with amenities, quantities, status, and note
        $items = [];
        foreach ($receivedItems as $index => $receivedItem) {
            $items[] = [
                'amenity_id' => $amenities[$index] ?? null,
                'quantity'   => $quantities[$index] ?? 1,
                'status'     => $receivedItem->status ?? 'Not Returned',  // Use status from LaundryReceived
                'note'       => $receivedItem->note ?? '',                // Use note from LaundryReceived
            ];
        }

        // Pass everything to the view
        return view('admin.laundry.receive', compact(
            'data', 'amenitiesList', 'vendorList', 'items', 'receivedItems'
        ));
    }


    public function receiveUpdate(Request $request, $id)
    { 
        $laundryId = $id; //$request->input('laundry_id');
        $assignDate = $request->input('assign_date');
        $vendorId = $request->input('vendor_id');
        $amenities   = $request->input('amenities_id', []);
        $quantities = $request->input('quantity', []);
        $statuses = $request->input('status', []);
        $notes     = $request->input('note', []);

        foreach ($amenities as $index => $amenityId) {
            LaundryReceived::updateOrCreate(
                [
                    'laundry_id'    => $laundryId,
                    'vendor_id'     => $vendorId,
                    'assign_date'   => $assignDate,
                    'amenities_id'  => $amenityId,
                ],
                [
                    'quantity' => $quantities[$index] ?? 0,
                    'status'   => $statuses[$index] ?? 'Not Returned',
                    'note'     => $notes[$index] ?? null,
                ]
            );
        }

        $receivedItems = LaundryReceived::where('laundry_id', $id)->get();

        // Check if all received items have status "Received"
        $allReceived = $receivedItems->every(function ($item) {
            return $item->status == 'Returned';
        });
        $data = Laundry::find($id);
        // If all items have status "Received", update the laundry status to 1 (or "Received")
        if ($allReceived) {
            $data->status = 1;  // Set Laundry status to "Received" (1)
            $data->save();
        }else{
            $data->status = 2;
            $data->save();
        }

        if($laundryId){
            return redirect()->route('admin.laundry.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.laundry.receive')->with('error', 'Data Update Failed.');
        }
    }

    public function details($id){
        // Fetch the laundry record
        $data = Laundry::find($id);

        // Get active amenities and vendors
        $amenitiesList = Amenities::where('status', 1)->get();
        $vendorList = Vendor::where('status', 1)->get();

        // Decode amenities and quantities from the Laundry model
        $amenities = json_decode($data->amenities_id, true); // ["2", "3"]
        $quantities = json_decode($data->quantity, true);    // ["2", "1"]

        // Fetch received items from the LaundryReceived table
        $receivedItems = LaundryReceived::where('laundry_id', $id)->orderBy('id','ASC')->get();

        // Pre-process received items with amenities, quantities, status, and note
        $items = [];
        foreach ($receivedItems as $index => $receivedItem) {
            $items[] = [
                'amenity_id' => $amenities[$index] ?? null,
                'quantity'   => $quantities[$index] ?? 1,
                'status'     => $receivedItem->status ?? 'Not Returned',  // Use status from LaundryReceived
                'note'       => $receivedItem->note ?? '',                // Use note from LaundryReceived
            ];
        }

        // Pass everything to the view
        return view('admin.laundry.details', compact(
            'data', 'amenitiesList', 'vendorList', 'items', 'receivedItems'
        ));
    }
}

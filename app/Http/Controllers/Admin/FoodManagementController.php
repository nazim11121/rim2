<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Food;
use App\Models\Admin\Dining;
use App\Models\Admin\CheckIn;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class FoodManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Food::latest()->get();

        return view('admin.food.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:foods|max:100',
            'type' => 'nullable',
            'category' => 'nullable',
            'price' => 'nullable',
            'priority' => 'nullable',
            'remarks' => 'nullable',
            'image' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('food-management/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/food'), $fileName);
            $filePath = 'uploads/food/' .$fileName;
        }else{
            $filePath = null;
        }
        $validatedData['image'] = $filePath;
        $validatedData['created_by'] = Auth::id();
        $dataStore = Food::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.food-management.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.food-management.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Food::find($id);

        return view('admin.food.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'type' => 'nullable',
            'category' => 'nullable',
            'price' => 'nullable',
            'priority' => 'nullable',
            'remarks' => 'nullable',
            'image' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('food-management/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        if ($request->file('image')) {

            $file = $request->file('image'); 
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/food'), $fileName);
            $filePath = 'uploads/food/' .$fileName;
        }else{
            $filePath = Food::find($id)->image;
        }

        $validatedData['image'] = $filePath;
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Food::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.food-management.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.food-management.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Food::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.food-management.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.food-management.index')->with('error', 'Data Delete Failed.');
        }
    }

    public function diningList()
    {
        $allData =  User::with('dining')->get();

        return view('admin.dining.index',compact('allData'));
    }

    public function diningCreate(){

        $customers = CheckIn::orderBy('id', 'DESC')->get();
        $foods = Food::where('status', 1)->get();

        return view('admin.dining.create',compact(['customers','foods']));
    }

    public function diningStore(Request $request){
       
         $data = $request->validate([
            'customer_id' => 'required|exists:check_ins,id',
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:foods,id',
            'cart.*.qty' => 'required|integer|min:1',
            'cart.*.price' => 'required',
            'cart.*.subtotal' => 'nullable',
        ]);

        // Example logic: save in a pivot table or orders table
        // $customer = \App\Models\CHeckIn::findOrFail($data['id']);

        // Optional: clear existing cart or orders
        // $customer->cartItems()->delete();

        foreach ($data['cart'] as $item) {
            // Save each item, example structure:
            Dining::create(
                ['user_id' => $data['customer_id'], 'food_id' => $item['id'],
                'quantity' => $item['qty'], 'price' => $item['price'], 'subtotal' => $item['qty']*$item['price'], 'status' => 1]
            );
        }

        return response()->json(['message' => 'Food Cart saved successfully!']);
    }

    public function diningEdit($id)
    {
        $customer = User::findOrFail($id);
        $customers = User::where('id', '!=', 1)->get();
        $foods = Food::where('status', 1)->get();

        // Get existing dining items for the customer
        $diningItems = Dining::where('user_id', $customer->id)->get();

        $cart = [];
        foreach ($diningItems as $item) {
            $cart[] = [
                'id' => $item->food_id,
                'name' => $item->food->name ?? '',
                'qty' => $item->quantity,
                'price' => $item->price
            ];
        }

        return view('admin.dining.edit', compact('customers', 'foods', 'customer', 'cart'));
    }

    public function diningUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:foods,id',
            'cart.*.qty' => 'required|integer|min:1',
            'cart.*.price' => 'required',
            'cart.*.subtotal' => 'required',
        ]);

        // Optional: clear old dining items for the user
        Dining::where('user_id', $id)->delete();

        foreach ($data['cart'] as $item) { 
            Dining::create([
                'user_id' => $data['customer_id'],
                'food_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
                'status' => 1
            ]);
        }

        return response()->json(['message' => 'Food Cart updated successfully!']);
    }

}

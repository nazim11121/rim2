<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Expense;
use Illuminate\Http\Request;
use Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData =  Expense::latest()->get();

        return view('admin.expense.index',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expense_title' => 'required',
            'receiver_name' => 'required',
            'payment_amount' => 'required',
            'due_amount' => 'required',
            'payment_method' => 'required',
            'note' => 'nullable',
            'status' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('account/expense/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['created_by'] = Auth::id();
        $dataStore = Expense::create($validatedData);

        if($dataStore){
            return redirect()->route('admin.expense.index')->with('success', 'Data Store Successful.');
        }else{
            return redirect()->route('admin.expense.create')->with('error', 'Data Store Failed.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Expense::find($id);

        return view('admin.expense.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { 
        $validator = Validator::make($request->all(), [
            'expense_title' => 'required',
            'receiver_name' => 'required',
            'payment_amount' => 'required',
            'due_amount' => 'nullable',
            'payment_method' => 'required',
            'note' => 'nullable',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('account/expense/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['updated_by'] = Auth::id();

        $dataUpdate = Expense::where('id', $id)->update($validatedData);

        if($dataUpdate){
            return redirect()->route('admin.expense.index')->with('info', 'Data Updated Successful.');
        }else{
            return redirect()->route('admin.expense.edit')->with('error', 'Data Update Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Expense::find($id);
        $data->delete();

        if($data){
            return redirect()->route('admin.expense.index')->with('danger', 'Data Deleted Successful.');
        }else{
            return redirect()->route('admin.expense.index')->with('error', 'Data Delete Failed.');
        }
    }
}

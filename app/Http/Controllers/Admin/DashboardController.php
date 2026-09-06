<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\CheckIn;
use App\Models\Admin\Checkout;
use App\Models\Admin\Expense;

Class DashboardController extends Controller
{
    public function index(){
        $totalCheckin = CheckIn::where('status', 1)->count();
        $totalCheckout = CheckIn::where('checkout_id', '!=',null)->count();
        $totalIncome = (int)Checkout::where('payment_status', 1)->sum('grand_total');
        $totalExpense = (int)Expense::where('status', 1)->sum('payment_amount');;

        return view('dashboard', compact(['totalCheckin','totalCheckout','totalIncome','totalExpense']));
    }
}

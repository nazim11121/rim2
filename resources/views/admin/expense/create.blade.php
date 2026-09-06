@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Account</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Expense</a>
                </li>
                <li class="nav-item">
                  <a href="#">Add</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Add Expenses</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.expense.store') }}" enctype="multipart/form-data">
                            @csrf
                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Expense Title <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="expense_title" id="expense_title" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Receiver Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="receiver_name" id="receiver_name" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Paid Amount<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="payment_amount" id="payment_amount" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Due Amount</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="due_amount" id="due_amount" value="0">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Payment Method<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="payment_method" name="payment_method" required>
                                            <option value="">-- Select Payment Method --</option>
                                            <option value="cash">Cash</option>
                                            <option value="bkash">Bkash</option>
                                            <option value="rocket">Rocket</option>
                                            <option value="nagad">Nagad</option>
                                            <option value="card">Card</option>
                                            <option value="bank">Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Note</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="note" id="note"></textarea>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="status" id="status" required>
                                            <option value="1">Paid</option>
                                            <option value="2">Partial</option>
                                            <option value="0">Unpaid</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="text-end">
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
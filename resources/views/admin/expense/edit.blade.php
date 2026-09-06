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
                  <a href="#">Edit</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Edit Expenses</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.expense.update', $data->id) }}" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                <!-- Name -->
                                 <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Expense Title <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="expense_title" id="expense_title" value="{{$data->expense_title}}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Receiver Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="receiver_name" id="receiver_name" value="{{$data->receiver_name}}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Paid Amount<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="payment_amount" id="payment_amount"  value="{{$data->payment_amount}}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Due Amount</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="due_amount" id="due_amount"  value="{{$data->due_amount}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Payment Method<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="payment_method" name="payment_method" required>
                                            <option value="">-- Select Payment Method --</option>
                                            <option value="cash" {{$data->payment_method=='cash'?'selected':''}}>Cash</option>
                                            <option value="bkash" {{$data->payment_method=='bkash'?'selected':''}}>Bkash</option>
                                            <option value="rocket" {{$data->payment_method=='rocket'?'selected':''}}>Rocket</option>
                                            <option value="nagad" {{$data->payment_method=='nagad'?'selected':''}}>Nagad</option>
                                            <option value="card" {{$data->payment_method=='card'?'selected':''}}>Card</option>
                                            <option value="bank" {{$data->payment_method=='bank'?'selected':''}}>Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Note</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="note" id="note" value="{{$data->note}}">{{$data->note}}</textarea>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="status" id="status" required>
                                            <option value="1" {{$data->status=='1'?'selected':''}}>Paid</option>
                                            <option value="2" {{$data->status=='2'?'selected':''}}>Partial</option>
                                            <option value="0" {{$data->status=='0'?'selected':''}}>Unpaid</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="text-end">
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                  <a href="#">Report</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Expense</a>
                </li>
                <li class="nav-item">
                  <a href="#">List</a>
                </li>
              </ul>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>🧾 Expense Report</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.report.expense') }}" class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">🔍 Filter</button>
                            </div>
                        </form>

                        @if($expenses->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Expense Title</th>
                                        <th>Receiver Name</th>
                                        <th>Payment Amount</th>
                                        <th>Due Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $key=>$expense)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{ date('d-m-Y',strtotime($expense->created_at)) }}</td>
                                            <td>{{ $expense->expense_title ?? '-' }}</td>
                                            <td>{{ $expense->receiver_name }}</td>
                                            <td>{{ number_format($expense->payment_amount, 2) }}</td>
                                            <td>{{ number_format($expense->due_amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-end">Grand Total</th>
                                        <th>{{ number_format($totalAmount, 2) }}</th>
                                        <th>{{ number_format($totalDue, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <p class="text-muted">No checkout records found for selected date range.</p>
                        @endif
                    </div>
                </div>
              </div>

            </div>
        </div>
    </div>
@endsection

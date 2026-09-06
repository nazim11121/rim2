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
                  <a href="#">Income</a>
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
                        <h4>🧾 Checkout Report</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.report.income') }}" class="row g-3 mb-4">
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

                        @if($checkouts->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Checkout Date</th>
                                        <th>Guest Name</th>
                                        <th>Guest ID</th>
                                        <th>Guest Mobile</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($checkouts as $key=>$checkout)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{ date('d-m-Y',strtotime($checkout->checkout_date)) }}</td>
                                            <td>{{ $checkout->checkIn->name ?? '-' }}</td>
                                            <td>{{ $checkout->checkIn->nid_no }}</td>
                                            <td>{{ $checkout->checkIn->mobile }}</td>
                                            <td>{{ number_format($checkout->grand_total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-end">Grand Total</th>
                                        <th>{{ number_format($totalAmount, 2) }}</th>
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

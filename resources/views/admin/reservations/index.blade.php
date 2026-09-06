@extends('layouts.app')
@section('content')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Online Booking</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Reservations</a></li>
                <li class="nav-item"><a href="#">List</a></li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                      <h4 class="card-title float-left">Reservations List</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Reference</th>
                            <th>Stay</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Guests</th>
                            <th>Guest Name</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($allData as $value)
                            <tr>
                              <td>{{$value->reference}}</td>
                              <td>{{$value->stay->name ?? ''}}</td>
                              <td>{{$value->check_in->toDateString()}}</td>
                              <td>{{$value->check_out->toDateString()}}</td>
                              <td>{{$value->guests}}</td>
                              <td>{{$value->guest_name}}</td>
                              <td>৳{{number_format($value->total)}}</td>
                              <td>{{ucfirst($value->status)}}</td>
                              <td>{{ucfirst($value->payment_status)}}</td>
                              <td class="text-nowrap">
                                  <a href="{{route('admin.reservations.show', $value->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
<script src="../assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<script>
  $(document).ready(function () {
    $("#multi-filter-select").DataTable({ pageLength: 10 });
  });
</script>

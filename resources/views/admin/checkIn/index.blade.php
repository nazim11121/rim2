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
                  <a href="#">Check In</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Booking</a>
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
                    <div class="d-flex justify-content-between align-items-center">
                      <h4 class="card-title float-left">Booking List</h4>
                      <a
                          href="{{route('admin.checkIn.create')}}"
                                type="button"
                                id="addRowButton"
                                class="btn btn-primary float-right"
                              >
                                Add
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="multi-filter-select"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Total Guest</th>
                            <th>Room No.</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <!-- <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Room No.</th>
                            <th>Floor</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                          </tr>
                        </tfoot> -->
                        <tbody>
                          @foreach($allData as $key=>$value)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$value->name}}</br>{{$value->mobile}}</td>
                              <td>Adults: {{$value->adult}}</br>Kids: {{$value->kids}}</td>
                              <td>
                                @php
                                    $roomIds = json_decode($value->room_id, true) ?? [];
                                    $roomNumbers = !empty($roomIds) ? \App\Models\Admin\Room::whereIn('id', $roomIds)->pluck('room_no')->toArray() : [];
                                @endphp
                                  {{implode(', ', $roomNumbers)}}
                              </td>
                              <td>{{ date('d-m-Y', strtotime($value->start_date))}} to {{ date('d-m-Y', strtotime($value->end_date))}}</td>
                              <td>@if($value->checkout_id!==null) <span class="badge badge-danger">Checkout</span>@elseif($value->status==1) <span class="badge badge-primary">Booked</span> @else<span>Incomplete</span>@endif</td>
                              <td class="text-nowrap">
                                  <a href="{{ $value->checkout_id == null ? route('admin.checkIn.edit', $value->id) : '#' }}"
                                    class="btn btn-primary btn-xs {{ $value->checkout_id != null ? 'disabled' : '' }}"
                                    @if($value->checkout_id != null) onclick="return false;" @endif>
                                    <i class="fa fa-edit"></i> Edit
                                  </a>
                                  <a href="{{route('admin.checkout.create', $value->id)}}" class="btn btn-info btn-xs"><i class="fa fa-view"></i> Checkout</a>
                                  <form action="{{ route('admin.checkIn.destroy', $value->id) }}" method="POST" style="display: inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this?')" @if($value->checkout_id!=null) disabled @endif>
                                          <i class="fa fa-trash"></i> Cancel
                                      </button>
                                  </form>
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

    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script>

@endsection    
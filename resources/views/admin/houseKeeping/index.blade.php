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
                  <a href="#">House Keeping</a>
                </li>
                <li class="nav-item">
                  <a href="#">All</a>
                </li>
              </ul>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                      <h4 class="card-title float-left">House Keeping All</h4>
                      <a
                          href="{{route('admin.house-keeping.create')}}"
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
                            <th>Item</th>
                            <th>Room No.</th>
                            <th>Assign To</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Remark</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <!-- <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Status</th>
                          </tr>
                        </tfoot> -->
                        <tbody>
                          @foreach($allData as $key=>$value)
                            <tr>
                              <td>
                                @php
                                    $amenitiesIds = json_decode($value->amenities_id, true) ?? [];
                                    $amenitiesName = !empty($amenitiesIds) ? \App\Models\Admin\Amenities::whereIn('id', $amenitiesIds)->pluck('name')->toArray() : [];
                                @endphp
                                  {{implode(', ', $amenitiesName)}}
                              </td>
                              <td>{{$value->room->room_no ?? ''}}</td>
                              <td>{{$value->vendor->name ?? ''}}</td>
                              <td>@if($value->status==1) <span>Clean</span>@else<span>Dirty</span>@endif</td>
                              <td>{{ date('d-m-Y', strtotime($value->created_at))}}</td>
                              <td>{{$value->description}}</td>
                              <td class="text-nowrap">
                                  <a href="{{route('admin.house-keeping.edit', $value->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                  <form action="{{ route('admin.house-keeping.destroy', $value->id) }}" method="POST" style="display: inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this?')">
                                          <i class="fa fa-trash"></i> Delete
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
@endsection
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
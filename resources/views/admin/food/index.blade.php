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
                  <a href="#">Food Management</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Food</a>
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
                      <h4 class="card-title float-left">Food List</h4>
                      <a
                          href="{{route('admin.food-management.create')}}"
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
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Catgeory</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Sort Order</th>
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
                              <td>{{++$key}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->type}}</td>
                              <td>{{$value->category}}</td>
                              <td>{{$value->price}}</td>
                              <td><img src="{{asset('/')}}{{$value->image}}" class="w-100"/></td>
                              <td>{{$value->priority}}</td>
                              <td>@if($value->status==1) <span>Active</span>@else<span>Inactive</span>@endif</td>
                              <td class="text-nowrap">
                                  <a href="{{route('admin.food-management.edit', $value->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                  <form action="{{ route('admin.food-management.destroy', $value->id) }}" method="POST" style="display: inline-block;">
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
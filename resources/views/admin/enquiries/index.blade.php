@extends('layouts.app')
@section('content')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Frontend Content</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Enquiries</a></li>
                <li class="nav-item"><a href="#">List</a></li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                      <h4 class="card-title float-left">Enquiries List</h4>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($allData as $value)
                            <tr>
                              <td>{{$value->name}}</td>
                              <td>{{$value->email}}</td>
                              <td>{{$value->phone}}</td>
                              <td>{{$value->subject}}</td>
                              <td>{{$value->type}}</td>
                              <td>{{ucfirst($value->status)}}</td>
                              <td>{{$value->created_at}}</td>
                              <td class="text-nowrap">
                                  <a href="{{route('admin.enquiries.show', $value->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View</a>
                                  <form action="{{ route('admin.enquiries.destroy', $value->id) }}" method="POST" style="display: inline-block;">
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
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<script>
  $(document).ready(function () {
    $("#multi-filter-select").DataTable({ pageLength: 10 });
  });
</script>

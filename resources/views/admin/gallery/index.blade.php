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
                <li class="nav-item"><a href="#">Gallery</a></li>
                <li class="nav-item"><a href="#">List</a></li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                      <h4 class="card-title float-left">Gallery List</h4>
                      <a href="{{route('admin.gallery.create')}}" class="btn btn-primary float-right">Add</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($allData as $value)
                            <tr>
                              <td><img src="{{$value->image}}" class="form-control" alt="img"/></td>
                              <td>{{$value->title}}</td>
                              <td>{{$value->category}}</td>
                              <td>@if($value->status==1) <span>Active</span>@else<span>Inactive</span>@endif</td>
                              <td class="text-nowrap">
                                  <a href="{{route('admin.gallery.edit', $value->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                  <form action="{{ route('admin.gallery.destroy', $value->id) }}" method="POST" style="display: inline-block;">
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

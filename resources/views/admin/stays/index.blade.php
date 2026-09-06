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
                <li class="nav-item"><a href="#">Stays</a></li>
                <li class="nav-item"><a href="#">List</a></li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                      <h4 class="card-title float-left">Stays List</h4>
                      <a href="{{route('admin.stays.create')}}" class="btn btn-primary float-right">Add</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Slug</th>
                            <th>Name</th>
                            <th>Guests</th>
                            <th>Pricing Mode</th>
                            <th>Sort</th>
                            <th>Published</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($allData as $value)
                            <tr>
                              <td>@if($value->hero_image)<img src="{{ asset($value->hero_image) }}" style="width:60px;height:40px;object-fit:cover;" alt="img"/>@endif</td>
                              <td>{{$value->slug}}</td>
                              <td>{{$value->name}}</td>
                              <td>{{$value->min_guests}}–{{$value->max_guests}}</td>
                              <td>{{$value->pricing_mode}}</td>
                              <td>{{$value->sort_order}}</td>
                              <td>@if($value->is_published) <span class="badge badge-success">Yes</span>@else<span class="badge badge-secondary">No</span>@endif</td>
                              <td class="text-nowrap">
                                  <a href="{{route('admin.stays.edit', $value->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                  <form action="{{ route('admin.stays.destroy', $value->id) }}" method="POST" style="display: inline-block;">
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

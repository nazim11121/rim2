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
                  <a href="#">Slider Management</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Slider</a>
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
                            <h4 class="mb-0">Edit Slider</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.slider.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Image <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="image" id="name" value="{{$data->image}}">
                                        @if ($data->image)
                                            <img src="{{ asset($data->image) }}" alt="Image" style="max-width: 150px; margin-top: 10px;">
                                        @endif
                                    </div>
                                </div>

                                <!-- Hierarchy -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Hierarchy</label>
                                    <div class="col-md-9">
                                        <input type="hierarchy" class="form-control" name="hierarchy" id="hierarchy" value="{{$data->hierarchy}}">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="status" id="status" required>
                                            <option value="1" {{$data->status==1?'selected':''}}>Active</option>
                                            <option value="0" {{$data->status==0?'selected':''}}>Inactive</option>
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
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
                  <a href="#">Room Management</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Room</a>
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
                            <h4 class="mb-0">Add Room</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.room.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                                <!-- Room Type -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Room Type <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="type" id="type" required>
                                            <option selected disabled>--Select--</option>
                                            @foreach($roomTypeList as $key=>$value)
                                                <option value="{{$value->id}}" {{$data->type==$value->id?'selected':''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}" required>
                                    </div>
                                </div>

                                <!-- Room No -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Room No. <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="room_no" id="room_no" value="{{$data->room_no}}" required>
                                    </div>
                                </div>

                                <!-- Floor -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Floor <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="floor" id="floor" required>
                                            <option selected disabled>--Select--</option>
                                            <option value="Ground Floor" {{$data->floor=='Ground Floor'?'selected':''}}>Ground Floor</option>
                                            <option value="1st Floor" {{$data->floor=='1st Floor'?'selected':''}}>1st Floor</option>
                                            <option value="2nd Floor" {{$data->floor=='2nd Floor'?'selected':''}}>2nd Floor</option>
                                            <option value="3rd Floor" {{$data->floor=='3rd Floor'?'selected':''}}>3rd Floor</option>
                                            <option value="4th Floor" {{$data->floor=='4th Floor'?'selected':''}}>4th Floor</option>
                                            <option value="5th Floor" {{$data->floor=='5th Floor'?'selected':''}}>5th Floor</option>
                                            <option value="6th Floor" {{$data->floor=='6th Floor'?'selected':''}}>6th Floor</option>
                                            <option value="7th Floor" {{$data->floor=='7th Floor'?'selected':''}}>7th Floor</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Sort Order -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                            <input type="number" class="form-control" name="priority" id="priority" value="{{$data->priority}}">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="description" id="description" value="{{$data->description}}">{{$data->description}}</textarea>
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image" class="form-control">
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
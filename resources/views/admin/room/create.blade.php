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
                  <a href="#">Add</a>
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
                            <form method="POST" action="{{ route('admin.room.store') }}" enctype="multipart/form-data">
                            @csrf
                                <!-- Room Type -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Room Type <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="type" id="type" required>
                                            <option selected disabled>--Select--</option>
                                            @foreach($roomTypeList as $key=>$value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>

                                <!-- Room No -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Room No. <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="room_no" id="room_no" required>
                                    </div>
                                </div>

                                <!-- Floor -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Floor <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="floor" id="floor" required>
                                            <option selected disabled>--Select--</option>
                                            <option value="Ground Floor">Ground Floor</option>
                                            <option value="1st Floor">1st Floor</option>
                                            <option value="2nd Floor">2nd Floor</option>
                                            <option value="3rd Floor">3rd Floor</option>
                                            <option value="4th Floor">4th Floor</option>
                                            <option value="5th Floor">5th Floor</option>
                                            <option value="6th Floor">6th Floor</option>
                                            <option value="7th Floor">7th Floor</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Sort Order -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                            <input type="number" class="form-control" name="priority" id="priority">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="description" id="description"></textarea>
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
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="text-end">
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
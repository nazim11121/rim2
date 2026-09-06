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
                  <a href="#">Room Type</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
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
                            <h4 class="mb-0">Add Room Type</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.type.store') }}" enctype="multipart/form-data">
                            @csrf
                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                </div>
                                <!-- Type -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="type" id="type" required>
                                            <!-- <option selected disabled>--Select--</option> -->
                                            <option value="Room">Room</option>
                                            <option value="Hall">Hall</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Short Code -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Short Code</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="sort_code" id="sort_code">
                                    </div>
                                </div>

                                <!-- Adult Capacity -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Adult Capacity <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="adult_capacity" id="adult_capacity" required>
                                    </div>
                                </div>

                                <!-- Kids Capacity -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Kids Capacity</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="kids_capacity" id="kids_capacity">
                                    </div>
                                </div>

                                <!-- Base Price -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Base Price <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="base_price" id="base_price" required>
                                    </div>
                                </div>

                                <!-- Sort Order -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="priority" id="priority">
                                    </div>
                                </div>
                            
                                <!-- Amenities -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Amenities <span class="text-danger">*</span></label>    

                                    <div class="row">
                                        <div class="col-md-4">
                                            @foreach($amenitiesList as $value)
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" value="{{$value->name}}">
                                                <label class="form-check-label" for="amenity1">{{$value->name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Description </label>
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
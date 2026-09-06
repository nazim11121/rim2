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
                  <a href="#">Edit</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Edit Room Type</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.type.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" id="name" value="{{$data->name}}" class="form-control" required>
                                    </div>
                                </div>
                                <!-- Type -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="type" id="type" required>
                                            <!-- <option selected disabled>--Select--</option> -->
                                            <option value="Room" {{$data->status==1?'Room':''}}>Room</option>
                                            <option value="Hall" {{$data->status==1?'Hall':''}}>Hall</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Short Code -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Short Code</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="short_code" id="short_code" value="{{$data->short_code}}">
                                    </div>
                                </div>

                                <!-- Adult Capacity -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Adult Capacity <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="adult_capacity" id="adult_capacity" value="{{$data->adult_capacity}}" required>
                                    </div>
                                </div>

                                <!-- Kids Capacity -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Kids Capacity</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="kids_capacity" id="kids_capacity" value="{{$data->kids_capacity}}">
                                    </div>
                                </div>

                                <!-- Base Price -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Base Price <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="base_price" id="base_price" value="{{$data->base_price}}" required>
                                    </div>
                                </div>

                                <!-- Sort Order -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="priority" id="priority" value="{{$data->priority}}">
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
                                <!-- <div class="col-md-12 mb-3">
                                    <label class="form-label">Amenities <span class="text-danger">*</span></label>    

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity1">
                                                <label class="form-check-label" for="amenity1">24H Reception</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity2">
                                                <label class="form-check-label" for="amenity2">Free Wifi</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity3">
                                                <label class="form-check-label" for="amenity3">Parking</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity4">
                                                <label class="form-check-label" for="amenity4">Electronics</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity5">
                                                <label class="form-check-label" for="amenity5">Free WIfi</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity6">
                                                <label class="form-check-label" for="amenity6">Premium Bedding</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity7">
                                                <label class="form-check-label" for="amenity7">Fancy Bathrobes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity8">
                                                <label class="form-check-label" for="amenity8">Healthy Breakfast</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="amenities_list[]" id="amenities_list" type="checkbox" id="amenity9">
                                                <label class="form-check-label" for="amenity9">Room Service</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Description </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="description" id="description" value="{{$data->description}}">{{$data->description}}</textarea>
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

                                <!-- Image Upload -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image" class="form-control">
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
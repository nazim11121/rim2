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
                  <a href="#">Edit</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Edit Food</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.food-management.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}" required>
                                    </div>
                                </div>
                                <!-- Type -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Food Type</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="type" id="type">
                                            <option selected disabled>--Select--</option>
                                                <option value="Deshi" {{$data->type=='Deshi'?'selected':''}}>Deshi</option>
                                                <option value="Foreign" {{$data->type=='Foreign'?'selected':''}}>Foreign</option>
                                                <option value="Veg" {{$data->type=='Veg'?'selected':''}}>Veg</option>
                                                <option value="Non Veg" {{$data->type=='Non Veg'?'selected':''}}>Non Veg</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Food Category <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="category" id="category" required>
                                            <option selected disabled>--Select--</option>
                                                <option value="Breakfast" {{$data->category=='Breakfast'?'selected':''}}>Breakfast</option>
                                                <option value="Lunch" {{$data->category=='Lunch'?'selected':''}}>Lunch</option>
                                                <option value="Dinner" {{$data->category=='Dinner'?'selected':''}}>Dinner</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Room No -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Price <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="price" id="price" value="{{$data->price}}" required>
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
                                        <textarea class="form-control" rows="3" name="remarks" id="remarks" value="{{$data->remarks}}">{{$data->remarks}}</textarea>
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
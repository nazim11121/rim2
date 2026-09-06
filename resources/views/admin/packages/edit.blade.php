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
                  <a href="#">Package Management</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Packages</a>
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
                            <h4 class="mb-0">Edit Packages</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.package.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Packages Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}" required>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Category <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="category_id" id="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{$data->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- No of Day -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">No of Day <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="no_of_day" id="no_of_day" value="{{$data->no_of_day}}" required>
                                    </div>
                                </div>

                                <!-- No of Person -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">No of Person(Max)<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="no_of_person" id="no_of_person" value="{{$data->no_of_person}}" required>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Price <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="price" id="price" value="{{$data->price}}" required>
                                    </div>
                                </div>

                                <!-- Price For -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Price For<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="price_for" id="price_for" required>
                                            <option value="Fixed" {{$data->price_for == 'Fixed'? 'selected':''}}>Fixed</option>
                                            <option value="Per Person" {{$data->price_for == 'Per Person'? 'selected':''}}>Per Person</option>
                                        </select>
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
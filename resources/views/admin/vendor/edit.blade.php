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
                  <a href="#">Vendors</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
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
                            <h4 class="mb-0">Edit Vendor Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.vendors.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <!-- Category -->
                                    <!-- <div class="col-md-6">
                                        <label class="form-label">Category *</label>
                                        <select class="form-select" name="category" required>
                                            <option value="">--Select--</option>
                                            <option value="1">Category 1</option>
                                            <option value="2">Category 2</option>
                                        </select>
                                    </div> -->

                                    <!-- Name -->
                                    <div class="col-md-12">
                                        <label class="form-label">Name *</label>
                                        <input type="text" class="form-control" name="name" value="{{$data->name}}" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">E-mail</label>
                                        <input type="email" class="form-control" name="email" value="{{$data->email}}">
                                    </div>

                                    <!-- Mobile No -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Mobile No.</label>
                                        <input type="text" class="form-control" name="mobile" value="{{$data->mobile}}">
                                    </div>

                                    <!-- gender No -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select" name="gender">
                                            <option value="">--Select--</option>
                                            <option value="Male" {{$data->gender=='Male'?'selected':''}}>Male</option>
                                            <option value="Female" {{$data->gender=='Female'?'selected':''}}>Female</option>
                                            <option value="Other" {{$data->gender=='Other'?'selected':''}}>Other</option>
                                        </select>
                                    </div>

                                    <!-- NID No -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">NID No.</label>
                                        <input type="text" class="form-control" name="nid_no" value="{{$data->nid_no}}">
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" name="address" rows="2" value="{{$data->address}}">{{$data->address}}</textarea>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>

                                <div class="mt-4 text-center">
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
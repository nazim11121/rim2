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
                  <a href="#">Add</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Add Food</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.food-management.store') }}" enctype="multipart/form-data">
                            @csrf
                                <!-- Name -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>
                                <!-- Type -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Food Type</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="type" id="type">
                                            <option selected disabled>--Select--</option>
                                                <option value="Deshi">Deshi</option>
                                                <option value="Foreign">Foreign</option>
                                                <option value="Veg">Veg</option>
                                                <option value="Non Veg">Non Veg</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Food Category <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="category" id="category" required>
                                            <option selected disabled>--Select--</option>
                                                <option value="Breakfast">Breakfast</option>
                                                <option value="Lunch">Lunch</option>
                                                <option value="Dinner">Dinner</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Room No -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Price <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="price" id="price" required>
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
                                        <textarea class="form-control" rows="3" name="remarks" id="remarks"></textarea>
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
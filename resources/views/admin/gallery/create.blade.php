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
                  <a href="#">Frontend Content</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Gallery</a>
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
                            <h4 class="mb-0">Add Gallery Image</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                            @csrf
                                <!-- Title -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="title" id="title">
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Category</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="category" id="category">
                                    </div>
                                </div>

                                <!-- Caption -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Caption</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="caption" id="caption"></textarea>
                                    </div>
                                </div>

                                <!-- Priority -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Priority</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="priority" id="priority">
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Image <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image" class="form-control" required>
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

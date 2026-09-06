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
                  <a href="#">Journal</a>
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
                            <h4 class="mb-0">Add Journal Post</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.journal.store') }}" enctype="multipart/form-data">
                            @csrf
                                <!-- Title -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Title <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="title" id="title" required>
                                    </div>
                                </div>

                                <!-- Excerpt -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Excerpt</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="excerpt" id="excerpt"></textarea>
                                    </div>
                                </div>

                                <!-- Body -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Body</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="8" name="body" id="body"></textarea>
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Category</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="category" id="category">
                                    </div>
                                </div>

                                <!-- Author -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Author</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="author" id="author">
                                    </div>
                                </div>

                                <!-- Published At -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Published At</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="published_at" id="published_at">
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

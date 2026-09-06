@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Online Booking</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Stays</a></li>
                <li class="nav-item"><a href="#">Add</a></li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Add Stay</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.stays.store') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Slug <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Meaning</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meaning" value="{{ old('meaning') }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Min Guests <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="min_guests" value="{{ old('min_guests', 1) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Max Guests <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="max_guests" value="{{ old('max_guests', 3) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Pricing Mode <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="pricing_mode" required>
                                            <option value="per_person_occupancy">Per Person Occupancy</option>
                                            <option value="per_person_group">Per Person Group</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Whole Unit Only</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="whole_unit_only">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Hero Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="hero_image" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', 0) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Published <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="is_published" required>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

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

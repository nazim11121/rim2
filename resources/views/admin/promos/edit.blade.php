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
                <li class="nav-item"><a href="#">Promos</a></li>
                <li class="nav-item"><a href="#">Edit</a></li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Edit Promo</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.promos.update', $data->id) }}">
                            @csrf
                            @method('PUT')
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Code <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="code" value="{{ old('code', $data->code) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Type <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="type" required>
                                            <option value="pct" {{ $data->type == 'pct' ? 'selected' : '' }}>Percentage</option>
                                            <option value="flat" {{ $data->type == 'flat' ? 'selected' : '' }}>Flat (Taka)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Value <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" step="0.0001" class="form-control" name="value" value="{{ old('value', $data->value) }}" required>
                                        <small class="form-text text-muted">0.10 = 10% if type is pct, or a flat taka amount if type is flat.</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Label <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="label" value="{{ old('label', $data->label) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Starts On</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="starts_on" value="{{ old('starts_on', $data->starts_on?->toDateString()) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Ends On</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="ends_on" value="{{ old('ends_on', $data->ends_on?->toDateString()) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Min Nights</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="min_nights" value="{{ old('min_nights', $data->min_nights) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Stays</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="stay_slugs[]" multiple size="5">
                                            @foreach($stays as $slug => $name)
                                                <option value="{{ $slug }}" {{ in_array($slug, (array) $data->stay_slugs) ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Leave empty for any stay.</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Max Uses</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="max_uses" value="{{ old('max_uses', $data->max_uses) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Max Uses Per Email</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="max_uses_per_email" value="{{ old('max_uses_per_email', $data->max_uses_per_email) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Active <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="is_active" required>
                                            <option value="1" {{ $data->is_active ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ !$data->is_active ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

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

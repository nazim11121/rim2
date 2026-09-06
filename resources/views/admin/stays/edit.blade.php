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
                <li class="nav-item"><a href="#">Edit</a></li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Edit Stay</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.stays.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Slug <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="slug" value="{{ old('slug', $data->slug) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Meaning</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meaning" value="{{ old('meaning', $data->meaning) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" name="description">{{ old('description', $data->description) }}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Min Guests <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="min_guests" value="{{ old('min_guests', $data->min_guests) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Max Guests <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="max_guests" value="{{ old('max_guests', $data->max_guests) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Pricing Mode <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="pricing_mode" required>
                                            <option value="per_person_occupancy" {{ $data->pricing_mode == 'per_person_occupancy' ? 'selected' : '' }}>Per Person Occupancy</option>
                                            <option value="per_person_group" {{ $data->pricing_mode == 'per_person_group' ? 'selected' : '' }}>Per Person Group</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Whole Unit Only</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="whole_unit_only">
                                            <option value="0" {{ !$data->whole_unit_only ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ $data->whole_unit_only ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Hero Image</label>
                                    <div class="col-md-9">
                                        @if($data->hero_image)
                                            <img src="{{ asset($data->hero_image) }}" style="width:120px;display:block;margin-bottom:8px;" alt="hero">
                                        @endif
                                        <input type="file" name="hero_image" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Sort Order</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $data->sort_order) }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Published <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="is_published" required>
                                            <option value="1" {{ $data->is_published ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ !$data->is_published ? 'selected' : '' }}>No</option>
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

                    <div class="card shadow mt-3">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Rate Tiers</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>From Guests</th>
                                        <th>Weekday Rate</th>
                                        <th>Weekend Rate</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data->rateTiers as $tier)
                                        <tr>
                                            <td>{{ $tier->from_guests }}</td>
                                            <td>{{ number_format($tier->weekday_rate) }}</td>
                                            <td>{{ number_format($tier->weekend_rate) }}</td>
                                            <td>
                                                <form action="{{ route('admin.rateTiers.destroy', $tier->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Remove this rate tier?')"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4">No rate tiers yet.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <form action="{{ route('admin.rateTiers.store') }}" method="POST" class="row g-2 align-items-end">
                                @csrf
                                <input type="hidden" name="stay_id" value="{{ $data->id }}">
                                <div class="col-md-3">
                                    <label class="form-label">From Guests</label>
                                    <input type="number" class="form-control" name="from_guests" min="1" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Weekday Rate</label>
                                    <input type="number" class="form-control" name="weekday_rate" min="0" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Weekend Rate</label>
                                    <input type="number" class="form-control" name="weekend_rate" min="0" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">Add / Update Tier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

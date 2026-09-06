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
                <li class="nav-item"><a href="#">Settings</a></li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Booking Settings</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.update') }}">
                            @csrf
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">VAT Rate <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" step="0.0001" min="0" max="1" class="form-control" name="vat_rate" value="{{ old('vat_rate', $data['vat_rate']) }}" required>
                                        <small class="form-text text-muted">e.g. 0.15 = 15%.</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Weekday Discount <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" step="0.0001" min="0" max="1" class="form-control" name="weekday_discount" value="{{ old('weekday_discount', $data['weekday_discount']) }}" required>
                                        <small class="form-text text-muted">e.g. 0.15 = 15% off Sunday to Thursday.</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Weekend Days <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="weekend_days" value="{{ old('weekend_days', $data['weekend_days']) }}" required>
                                        <small class="form-text text-muted">Comma-separated day numbers, 0=Sunday. e.g. 5,6 for Friday and Saturday.</small>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Property Max Guests <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" min="1" class="form-control" name="property_max_guests" value="{{ old('property_max_guests', $data['property_max_guests']) }}" required>
                                    </div>
                                </div>

                                <p class="text-muted">
                                    Holidays are not editable here. Set them via tinker or a seeder, e.g.
                                    <code>Setting::put('holidays', ['2026-12-16'])</code>.
                                </p>

                                <div class="text-end">
                                        <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

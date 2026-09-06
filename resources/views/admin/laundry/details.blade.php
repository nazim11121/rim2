@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">

        {{-- Breadcrumbs --}}
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Laundry</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Details</a></li>
            </ul>
        </div>

        {{-- Laundry Details Card --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow border-0">
                    
                    {{-- Header --}}
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">🧺 Laundry Receive Details</h4>
                        <span class="badge bg-primary">ID: {{ $data->id }}</span>
                    </div>

                    {{-- Body --}}
                    <div class="card-body">
                        <form id="laundryForm" action="#" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- General Info --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Assign Date</label>
                                    <div class="form-control bg-light">
                                        {{ \Carbon\Carbon::parse($data->assign_date)->format('d M, Y') }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Vendor</label>
                                    <div class="form-control bg-light">
                                        {{ optional($vendorList->firstWhere('id', $data->vendor_id))->name }}
                                    </div>
                                    <input type="hidden" name="vendor_id" value="{{ $data->vendor_id }}">
                                </div>
                            </div>

                            {{-- Laundry Items --}}
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>Laundry Item</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $index => $item)
                                            <tr>
                                                {{-- Laundry Item --}}
                                                <td>
                                                    <span class="fw-semibold">
                                                        {{ optional($amenitiesList->firstWhere('id', $item['amenity_id']))->name }}
                                                    </span>
                                                    <input type="hidden" name="amenities_id[]" value="{{ $item['amenity_id'] }}">
                                                </td>

                                                {{-- Quantity --}}
                                                <td class="text-center">
                                                    <span class="badge bg-info text-dark fs-6">
                                                        {{ $item['quantity'] }}
                                                    </span>
                                                    <input type="hidden" name="quantity[]" value="{{ $item['quantity'] }}">
                                                </td>

                                                {{-- Status --}}
                                                <td class="text-center">
                                                    @if($item['status'] == 'Returned')
                                                        <span class="badge bg-success">Returned</span>
                                                    @else
                                                        <span class="badge bg-danger">Not Returned</span>
                                                    @endif
                                                    <input type="hidden" name="status[]" value="{{ $item['status'] }}">
                                                </td>

                                                {{-- Note --}}
                                                <td>
                                                    <p class="mb-0 text-muted">{{ $item['note'] ?? '—' }}</p>
                                                    <input type="hidden" name="note[]" value="{{ $item['note'] }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="text-end mt-4">
                                <a href="{{ route('admin.laundry.index') }}" class="btn btn-secondary px-4">
                                    <i class="icon-arrow-left"></i> Back
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

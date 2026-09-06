@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Laundry</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Receive</a></li>
            </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Laundry Receive Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="laundryForm" action="{{ route('admin.laundry.receive.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Assign Date & Vendor --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Assign Date *</label>
                                    <input type="date" class="form-control" name="assign_date" 
                                           value="{{ old('assign_date', $data->assign_date) }}" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Vendor *</label>
                                    <select class="form-control" name="vendor_id" disabled>
                                        <option value="">Select Vendor</option>
                                        @foreach($vendorList as $vendor)
                                            <option value="{{ $vendor->id }}" {{ $vendor->id == $data->vendor_id ? 'selected' : '' }}>
                                                {{ $vendor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="vendor_id" value="{{ $data->vendor_id }}">
                                </div>
                            </div>

                            {{-- Laundry Items Table --}}
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Laundry Item</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody id="laundryTable">
                                        @foreach($items as $index => $item)
                                            <tr>
                                                <td>
                                                    <select class="form-select" disabled>
                                                        <option value="">Select Laundry Item</option>
                                                        @foreach($amenitiesList as $laundryItem)
                                                            <option value="{{ $laundryItem->id }}"
                                                                {{ $laundryItem->id == $item['amenity_id'] ? 'selected' : '' }}>
                                                                {{ $laundryItem->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="amenities_id[]" value="{{ $item['amenity_id'] }}">
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control" name="quantity[]"
                                                        value="{{ $item['quantity'] }}" min="1" readonly>
                                                </td>

                                                <td>
                                                    <select class="form-select" name="status[]">
                                                        <option value="Not Returned" {{ $item['status'] == 'Not Returned' ? 'selected' : '' }}>
                                                            Not Returned
                                                        </option>
                                                        <option value="Returned" {{ $item['status'] == 'Returned' ? 'selected' : '' }}>
                                                            Returned
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control" name="note[]"
                                                        value="{{ $item['note'] }}" placeholder="Enter note...">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Submit Button --}}
                            <div class="text-end mt-3">
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

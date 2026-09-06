@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Laundry</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Edit Laundry</h4>
                    </div>
                    <div class="card-body">
                        <form id="laundryForm" action="{{ route('admin.laundry.update', $laundry->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="table-responsive">
                                <div class="d-flex">

                                    {{-- Assign Date --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Date *</label>
                                        <input type="date" class="form-control"
                                               name="assign_date"
                                               value="{{ old('assign_date', $laundry->assign_date) }}"
                                               required>
                                    </div>

                                    {{-- Vendor --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Vendor *</label>
                                        <select class="form-control select2" name="vendor_id" required>
                                            <option value="">Select Vendor</option>
                                            @foreach($vendorList as $vendor)
                                                <option value="{{ $vendor->id }}"
                                                    {{ $vendor->id == $laundry->vendor_id ? 'selected' : '' }}>
                                                    {{ $vendor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <br>

                                {{-- Laundry Items --}}
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Laundry Item</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="laundryTable">
                                        @foreach(json_decode($laundry->amenities_id, true) as $index => $amenityId)
                                            <tr>
                                                <td>
                                                    <select class="form-select" name="amenities_id[]">
                                                        <option value="">Select Laundry Item</option>
                                                        @foreach($amenitiesList as $laundryItem)
                                                            <option value="{{ $laundryItem->id }}"
                                                                {{ $laundryItem->id == $amenityId ? 'selected' : '' }}>
                                                                {{ $laundryItem->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control"
                                                        name="quantity[]"
                                                        value="{{ json_decode($laundry->quantity, true)[$index] ?? 1 }}"
                                                        min="1">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger removeRow">-</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- Add Row Button --}}
                                <div class="text-end mb-3">
                                    <button type="button" class="btn btn-primary addRow">+ Add Row</button>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS Section --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        // Add new row
        $(document).on("click", ".addRow", function () {
            let row = `
            <tr>
                <td>
                    <select class="form-select" name="amenities_id[]">
                        <option value="">Select Laundry Item</option>
                        @foreach($amenitiesList as $laundryItem)
                            <option value="{{ $laundryItem->id }}">{{ $laundryItem->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control" name="quantity[]" value="1" min="1">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger removeRow">-</button>
                </td>
            </tr>`;
            $("#laundryTable").append(row);
        });

        // Remove row
        $(document).on("click", ".removeRow", function () {
            $(this).closest("tr").remove();
        });

    });
</script>
@endsection

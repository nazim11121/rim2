@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" rel="stylesheet">
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
                  <a href="#">House Keeping</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
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
                            <h4 class="mb-0">Add</h4>
                        </div>
                       <div class="card-body">
                          <form action="{{route('admin.house-keeping.store')}}" method="POST">
                              @csrf
                              <div class="row">
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label fw-bold">Housekeeping Item <span class="text-danger">*</span></label>
                                      <select id="housekeeping-item" name="amenities_id[]" class="form-select select2" multiple required>
                                          <!-- <option value="">--Select--</option> -->
                                          @foreach($amenitiesList as $amenity)
                                              <option value="{{$amenity->id}}">{{$amenity->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label fw-bold">Room <span class="text-danger">*</span></label>
                                      <select class="form-select" name="room_no" required>
                                          <option value="">--Select--</option>
                                          @foreach($roomList as $room)
                                              <option value="{{$room->id}}">{{$room->room_no}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label fw-bold">Housekeeping Status <span class="text-danger">*</span></label>
                                      <div class="d-flex">
                                          <select class="form-select" name="status" required>
                                              <option value="">--Select--</option>
                                              <option value="1">Clean</option>
                                              <option value="0">Dirty</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label fw-bold">Assigned to <span class="text-danger">*</span></label>
                                      <select class="form-select" name="vendor_id">
                                          <option value="">--Select--</option>
                                          @foreach($vendorList as $vendor)
                                              <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label fw-bold">Remark</label>
                                      <textarea class="form-control" name="description" rows="3" placeholder="Enter remark"></textarea>
                                  </div>
                              </div>
                              <div class="d-flex justify-content-end">
                                  <button type="reset" class="btn btn-primary me-2">Reset</button>
                                  <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                          </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/10.2.0/choices.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Choices('#housekeeping-item', { removeItemButton: true });
    });
</script>
    <script>
    $(function() {
        if ($.fn.multiselect) {
            $('#housekeeping-item').multiselect({
                nonSelectedText: 'Select Housekeeping Items',
                enableFiltering: true,
                buttonWidth: '100%',
                maxHeight: 200
            });
        } else {
            console.error("Bootstrap Multiselect plugin is not loaded!");
        }
    });
</script>


@endsection
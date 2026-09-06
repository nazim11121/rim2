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
                  <a href="#">Check In</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Form</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Edit</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Edit Check In Information</h4>
                        </div>
                        <div class="container">
                            <form method="POST" action="{{ route('admin.checkIn.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="booking_id" value="{{ $data->id }}">
                                <!-- Date Selection -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Check-In Date -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-bold">Check In <span class="text-danger">*</span></label>
                                                <input type="date" name="start_date" id="start_date" value="{{$data->start_date}}" class="form-control" required>
                                            </div>
                                            <!-- Check-Out Date -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-bold">Check Out <span class="text-danger">*</span></label>
                                                <input type="date" name="end_date" id="end_date" value="{{$data->end_date}}" class="form-control" required>
                                            </div>
                                            <!-- Duration of Stay -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label fw-bold">Duration of Stay <span class="text-danger">*</span></label>
                                                <input type="number" name="day" id="day" class="form-control" value="{{$data->day}}" required readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Adults -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Adults <span class="text-danger">*</span></label>
                                                <input type="number" name="adult" id="adult" value="{{$data->adult}}" class="form-control" value="1" min="1" required>
                                            </div>
                                            <!-- Kids -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Kids</label>
                                                <input type="number" name="kids" id="kids" value="{{$data->kids}}" class="form-control" value="0" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Select Package</label>
                                                <select class="form-control" name="package_id" id="package_id">
                                                    <option value="">--Select--</option>
                                                    @foreach($packageList as $package)
                                                        <option value="{{ $package->id }}" {{$package->id==$data->package_id ? 'selected':''}}>{{ $package->name }} - {{ $package->price }}.00</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Room Selection Section -->
                                @foreach($roomList as $roomType)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h6><i class="bi bi-list"></i> {{ $roomType->name }} <span class="text-danger fw-bold"> {{ $roomType->base_price }}.00</span> / per room</h6>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Select</th>
                                                        <th>Room No.</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($roomType->rooms as $room)
                                                        <tr>
                                                            <td><input type="checkbox" name="room_id[]" value="{{ $room->id }}" 
                                                                {{ in_array($room->id, $selectedRooms ?? []) ? 'checked' : '' }}
                                                                {{ $room->available_status == 1 && !in_array($room->id, $selectedRooms ?? []) ? 'disabled' : '' }}>
                                                            </td>
                                                            <td>{{ $room->room_no }}</td>
                                                            <td>
                                                                @if($room->available_status == 1)
                                                                    <span class="badge bg-secondary">Booked</span>
                                                                @else
                                                                    <span class="badge bg-success">Available</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Guest Information Section -->
                                <div class="card mt-4">
                                    <!-- <div class="card-header">
                                        <h5>Guest Type</h5>
                                        <div>
                                            <input type="radio" name="guestType" checked> New Guest
                                            <input type="radio" name="guestType"> Existing Guest
                                        </div>
                                    </div> -->
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Full Name *</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}" placeholder="Enter First Name" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Mobile No. *</label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" value="{{$data->mobile}}" placeholder="Enter Mobile No." required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">E-mail</label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{$data->email}}" placeholder="Enter E-mail">
                                            </div>
                                        </div>
                                        <div class="row g-3 mt-2">
                                            <div class="col-md-2">
                                                <label class="form-label">Age</label>
                                                <input type="number" class="form-control" name="age" id="age" value="{{$data->age}}" placeholder="Enter Age">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Gender *</label>
                                                <select class="form-control" name="gender" id="gender" required>
                                                    <option value="">--Select--</option>
                                                    <option value="Male" {{$data->gender=='Male'?'selected':''}}>Male</option>
                                                    <option value="Female" {{$data->gender=='Female'?'selected':''}}>Female</option>
                                                    <option value="Other" {{$data->gender=='Other'?'selected':''}}>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Address *</label>
                                                <input type="text" class="form-control" name="address" id="address" value="{{$data->address}}" placeholder="Enter Address" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">NID No. *</label>
                                                <input type="number" class="form-control" name="nid_no" id="nid_no" value="{{$data->nid_no}}" placeholder="Enter NID No." required>
                                            </div>
                                        </div>
                                        <div class="row g-3 mt-2">
                                            <div class="col-md-4">
                                                <label class="form-label">Document</label>
                                                <input type="file" class="form-control" name="file" id="file" accept="image/*">

                                                {{-- Preview Section --}}
                                                <div class="mt-2">
                                                    <img id="preview" 
                                                        src="{{ $data->file ? asset('/' . $data->file) : 'https://via.placeholder.com/150x100?text=No+Image' }}" 
                                                        alt="Document Preview" 
                                                        class="img-thumbnail" 
                                                        width="150">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include jQuery -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('file').addEventListener('change', function(event) {
        let preview = document.getElementById('preview');
        let file = event.target.files[0];

        if (file) {
            // only preview image files
            if (file.type.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                // if not image, show placeholder
                preview.src = "https://via.placeholder.com/150x100?text=File+Not+Image";
            }
        }
    });
</script>
<script>
  $(document).ready(function () {console.log('hi');
      function calculateDuration() {
          let checkIn = new Date($('#start_date').val());
          let checkOut = new Date($('#end_date').val());
          
          if (checkIn && checkOut) {
              let timeDiff = checkOut.getTime() - checkIn.getTime();
              let daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days
              console.log('hi');
              if (daysDiff > 0) {
                  $('#day').val(daysDiff);
              } else {
                  $('#day').val(0); // Prevent negative values
              }
          }
      }

      // Trigger calculation on date change
      $('#start_date, #end_date').on('change', function () {
          calculateDuration();
      });
  });
</script>
@endsection
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
                  <a href="#">Form1</a>
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
                            <h4 class="mb-0">Add Check In Information</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.checkIn.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Check-In Date -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Check In <span class="text-danger">*</span></label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                                    </div>
                                    <!-- Check-Out Date -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Check Out <span class="text-danger">*</span></label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                                    </div>
                                    <!-- Duration of Stay -->
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Duration of Stay <span class="text-danger">*</span></label>
                                        <input type="number" name="day" id="day" class="form-control" value="0" required readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Adults -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Adults <span class="text-danger">*</span></label>
                                        <input type="number" name="adult" id="adult" class="form-control" value="1" min="1" required>
                                    </div>
                                    <!-- Kids -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Kids</label>
                                        <input type="number" name="kids" id="kids" class="form-control" value="0" min="0">
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="text-end">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-success">Next</button>
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
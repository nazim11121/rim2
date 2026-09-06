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
                  <a href="#">Check Out</a>
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
                  <a href="#">Store</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Check out Information</h4>
                        </div>
                        <div class="container">
                            <form method="POST" action="{{ route('admin.checkout.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="booking_id" value="{{ $data->id }}">
                                <!-- Date Selection -->
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Full Name *</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}" placeholder="Enter First Name" required readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Mobile No. *</label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" value="{{$data->mobile}}" placeholder="Enter Mobile No." required readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">E-mail</label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{$data->email}}" placeholder="Enter E-mail" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Total Guest</label>
                                                <input type="text" class="form-control" name="adult" id="adult" value="{{$data->adult + $data->kids}}" placeholder="" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">CheckIn/CheckOut</label>
                                                <input type="text" class="form-control" name="start_date" id="start_date" value="{{$data->start_date .' to '. $data->end_date}}" placeholder="" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Total Duration of Stay</label>
                                                <input type="text" class="form-control" name="day" id="day" value="{{$data->day}}" placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Room Selection Section -->
                                @foreach($selectedRooms as $value)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <label class="form-label">Room Details</label>
                                                <ul>
                                                    @foreach($rooms as $room)
                                                        <li>Room No : {{ $room->room_no ?? ''}}</li><li> Room Name : {{ $room->name ?? ''}}</li><li> Room Type: {{ $room->roomType->name ?? '' }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="card mt-4">
    <div class="card-body">
        <h5 class="mb-3">Billing Information</h5>
        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Room/Package Cost</label>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control cost" name="room_cost" id="room_cost" value="{{$checkoutData ? $checkoutData->room_cost:$roomCost}}">
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Laundry Cost</label>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control cost" name="laundry_cost" id="laundry_cost" value="{{$checkoutData ? $checkoutData->laundry_cost:0.00}}">
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Food Cost</label>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control cost" name="food_cost" id="food_cost" value="{{$checkoutData ? $checkoutData->food_cost:$foodCost}}">
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Service Cost</label>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control cost" name="service_cost" id="service_cost" value="{{$checkoutData ? $checkoutData->service_cost:0.00}}">
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Other Cost</label>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control cost" name="other_cost" id="other_cost" value="{{$checkoutData ? $checkoutData->other_cost:0.00}}">
            </div>
        </div>

        <hr>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Subtotal</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="subtotal" id="subtotal" value="" readonly>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">VAT (%)</label>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control" id="vat" name="vat" value="{{$checkoutData ? $checkoutData->vat:0}}">
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Discount Type</label>
            <div class="col-md-6">
                <select class="form-control" id="discount_type" name="discount_type">
                    <option value="percent"{{ isset($checkoutData) && $checkoutData->discount_type=='percent' ? 'selected':''}}>Percentage (%)</option>
                    <option value="amount"{{ isset($checkoutData) && $checkoutData->discount_type=='amount' ? 'selected':''}}>Flat Amount</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Discount</label>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{$checkoutData ? $checkoutData->vat:0}}">
            </div>
        </div>



        <div class="row mb-2">
            <label class="col-md-6 col-form-label fw-bold">Grand Total</label>
            <div class="col-md-6">
                <input type="text" class="form-control fw-bold" name="grand_total" id="grand_total" readonly>
            </div>
        </div>

        <div class="row mb-2">
    <label class="col-md-6 col-form-label fw-bold">Payment Method</label>
    <div class="col-md-6">
        <select class="form-control" id="payment_method" name="payment_method" required>
            <option value="">-- Select Payment Method --</option>
            <option value="cash"{{ isset($checkoutData) && $checkoutData->payment_method=='cash' ? 'selected':''}}>Cash</option>
            <option value="bkash"{{ isset($checkoutData) && $checkoutData->payment_method=='bkash' ? 'selected':''}}>Bkash</option>
            <option value="rocket"{{ isset($checkoutData) && $checkoutData->payment_method=='rocket' ? 'selected':''}}>Rocket</option>
            <option value="nagad"{{ isset($checkoutData) && $checkoutData->payment_method=='nagad' ? 'selected':''}}>Nagad</option>
            <option value="card"{{ isset($checkoutData) && $checkoutData->payment_method=='card' ? 'selected':''}}>Card</option>
            <option value="bank"{{ isset($checkoutData) && $checkoutData->payment_method=='bank' ? 'selected':''}}>Bank Transfer</option>
        </select>
    </div>
</div>

<!-- Transaction No (only for non-cash payments) -->
<div class="row mb-2 d-none" id="transaction_row">
    <label class="col-md-6 col-form-label fw-bold" id="transaction_label">Transaction No</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Enter transaction/reference no." value="{{$checkoutData ? $checkoutData->transaction_id:''}}">
    </div>
</div>
        @if($checkoutData)
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        @else
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        @endif
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
    function calculateTotal() {
        let subtotal = 0;

        // Sum all cost inputs
        $('.cost').each(function() {
            subtotal += parseFloat($(this).val()) || 0;
        });

        // Show subtotal
        $('#subtotal').val(subtotal.toFixed(2));

        // VAT calculation
        let vatPercent = parseFloat($('#vat').val()) || 0;
        let vatAmount = subtotal * (vatPercent / 100);

        // Discount calculation
        let discountType = $('#discount_type').val();
        let discountInput = parseFloat($('#discount').val()) || 0;
        let discountAmount = 0;

        if (discountType === 'percent') {
            discountAmount = subtotal * (discountInput / 100);
        } else {
            discountAmount = discountInput;
        }

        // Grand total
        let grandTotal = subtotal + vatAmount - discountAmount;
        $('#grand_total').val(grandTotal.toFixed(2));
    }

    // Run calculation on page load
    $(document).ready(function() {
        calculateTotal();

        // Recalculate on input change
        $('.cost, #vat, #discount, #discount_type').on('input change', function() {
            calculateTotal();
        });
    });
</script>
<script>
    $(document).ready(function () {
        calculateTotal();

        // Recalculate totals on input changes
        $('.cost, #vat, #discount, #discount_type').on('input change', function () {
            calculateTotal();
        });

        // Payment Method Change
        $('#payment_method').on('change', function () {
            let method = $(this).val();

            if (method === 'cash' || method === '') {
                $('#transaction_row').addClass('d-none');
                $('#transaction_id').val('');
            } else {
                $('#transaction_row').removeClass('d-none');

                // Change label dynamically
                if (method === 'bkash') {
                    $('#transaction_label').text('Bkash Transaction No');
                } else if (method === 'rocket') {
                    $('#transaction_label').text('Rocket Transaction No');
                } else if (method === 'nagad') {
                    $('#transaction_label').text('Nagad Transaction No');
                } else if (method === 'card') {
                    $('#transaction_label').text('Card Name with card No/Ref No/Transaction No');
                } else if (method === 'bank') {
                    $('#transaction_label').text('Bank Name with Ref No/Transaction No');
                } else {
                    $('#transaction_label').text('Transaction No');
                }
            }
        });
    });
</script>
@endsection
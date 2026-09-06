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
                <li class="nav-item"><a href="#">Reservations</a></li>
                <li class="nav-item"><a href="#">View</a></li>
              </ul>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Reservation {{ $data->reference }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Stay</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->stay->name ?? '' }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Check In</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->check_in->toDateString() }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Check Out</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->check_out->toDateString() }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Nights</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->nights }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Guests</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->guests }}</p></div></div>

                            <hr>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Guest Name</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->guest_name }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Phone</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->guest_phone }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Email</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->guest_email ?? '—' }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Note</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->guest_note ?? '—' }}</p></div></div>

                            <hr>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Promo</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->promo_code ?? '—' }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Nightly Rate</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->nightly_rate) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Gross</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->gross) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Weekday Discount</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->weekday_discount) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Promo Discount</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->promo_discount) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Net</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->net) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">VAT</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->vat) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Total</label><div class="col-md-9"><p class="form-control-plaintext"><strong>৳{{ number_format($data->total) }}</strong></p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Amount Paid</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->amount_paid) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Balance Due</label><div class="col-md-9"><p class="form-control-plaintext">৳{{ number_format($data->balanceDue()) }}</p></div></div>

                            <hr>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Status</label><div class="col-md-9"><p class="form-control-plaintext">{{ ucfirst($data->status) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Payment Status</label><div class="col-md-9"><p class="form-control-plaintext">{{ ucfirst($data->payment_status) }}</p></div></div>
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Source</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->source }}</p></div></div>
                            @if($data->cancel_reason)
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Cancel Reason</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->cancel_reason }}</p></div></div>
                            @endif
                            <div class="mb-3 row"><label class="col-md-3 col-form-label">Created At</label><div class="col-md-9"><p class="form-control-plaintext">{{ $data->created_at }}</p></div></div>

                            @if(!in_array($data->status, ['confirmed', 'cancelled', 'completed', 'no_show']))
                            <div class="mb-3 row">
                                <div class="col-md-9 offset-md-3">
                                    <form action="{{ route('admin.reservations.confirm', $data->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Confirm this reservation?')">Confirm</button>
                                    </form>
                                </div>
                            </div>
                            @endif

                            @if($data->status !== 'cancelled')
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Cancel</label>
                                <div class="col-md-9">
                                    <form action="{{ route('admin.reservations.cancel', $data->id) }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="cancel_reason" class="form-control" placeholder="Reason for cancellation" required>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Cancel this reservation?')">Cancel Reservation</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif

                            <div class="text-end">
                                <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h4 class="mb-0">Invoice #{{ $allData->invoice }}</h4>
                <button class="btn btn-sm btn-success" onclick="printInvoice()">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>

            <div class="card-body" id="invoiceArea">
                <div class="text-center mb-4">
                    <h3>{{env('APP_NAME')}}</h3>
                    <p><strong>Date:</strong> {{ now()->format('d M, Y') }}</p>
                    <h6 class="mb-0">Invoice #{{ $allData->invoice }}</h6>
                </div>

                <h5>👤 Guest Information</h5>
                <table class="table table-bordered">
                    <tr><th>Name</th><td>{{ $allData->name }}</td></tr>
                    <tr><th>NID</th><td>{{ $allData->nid_no }}</td></tr>
                    <tr><th>Mobile</th><td>{{ $allData->mobile }}</td></tr>
                    <tr><th>Email</th><td>{{ $allData->email ?? '-' }}</td></tr>
                    <tr><th>Address</th><td>{{ $allData->address ?? '-' }}</td></tr>
                    <tr><th>Guests</th><td>{{ $allData->adult + $allData->kids }}</td></tr>
                    <tr><th>Stay Duration</th><td>{{ $allData->start_date }} to {{ $allData->end_date }} ({{ $allData->day }} days)</td></tr>
                </table>

                @if($allData->package_id != null && $allData->package)
                  <div class="mb-3">
                      <h5>📦 Package Information</h5>
                      <table class="table table-bordered">
                          <tr>
                              <th>Package Name</th>
                              <td>{{ $allData->package->name }}</td>
                          </tr>
                          <tr>
                              <th>Description</th>
                              <td>{{ $allData->package->description ?? '-' }}</td>
                          </tr>
                          <tr>
                              <th>Price</th>
                              <td>{{ number_format($allData->package->price, 2) }}</td>
                          </tr>
                      </table>
                  </div>
                @endif

                <h5>🏨 Room Information</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Room No</th>
                            <th>Room Name</th>
                            <th>Type</th>
                            <th>Base Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->room_no }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->roomType->name ?? '-' }}</td>
                            <td>@if($allData->package_id==null){{ number_format($room->roomType->base_price ?? 0, 2) }}@endif</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5>🧾 Billing Information</h5>
                <table class="table table-bordered">
                    <tr><th>Room/Package Cost</th><td>{{ number_format($allData->checkout->room_cost ?? 0, 2) }}</td></tr>
                    <tr><th>Laundry</th><td>{{ number_format($allData->checkout->laundry_cost ?? 0, 2) }}</td></tr>
                    <tr><th>Food</th><td>{{ number_format($allData->checkout->food_cost ?? 0, 2) }}</td></tr>
                    <tr><th>Service</th><td>{{ number_format($allData->checkout->service_cost ?? 0, 2) }}</td></tr>
                    <tr><th>Other</th><td>{{ number_format($allData->checkout->other_cost ?? 0, 2) }}</td></tr>
                    <tr><th>Subtotal</th><td>{{ number_format($allData->checkout->subtotal ?? 0, 2) }}</td></tr>
                    <tr><th>VAT</th><td>{{ $allData->checkout->vat ?? 0 }} %</td></tr>
                    <tr><th>Discount</th><td>
                        {{ $allData->checkout->discount ?? 0 }}
                        @if($allData->checkout->discount_type === 'percent') % @else Tk @endif
                    </td></tr>
                    <tr class="table-active">
                        <th>Grand Total</th>
                        <td><strong>{{ number_format($allData->checkout->grand_total ?? 0, 2) }}</strong></td>
                    </tr>
                    <tr><th>Payment Method</th><td>{{ ucfirst($allData->checkout->payment_method ?? '-') }}</td></tr>
                    @if($allData->checkout->transaction_id)
                        <tr><th>Transaction/Ref</th><td>{{ $allData->checkout->transaction_id }}</td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function printInvoice() {
    let printContents = document.getElementById('invoiceArea').innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}
</script>
@endsection

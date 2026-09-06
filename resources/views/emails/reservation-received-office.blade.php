<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: sans-serif; color: #222; line-height: 1.6;">
    <h2>New reservation request — {{ $reservation->reference }}</h2>

    <table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
        <tr><td><strong>Reference</strong></td><td>{{ $reservation->reference }}</td></tr>
        <tr><td><strong>Stay</strong></td><td>{{ $reservation->stay->name }}</td></tr>
        <tr><td><strong>Check-in</strong></td><td>{{ $reservation->check_in->toDateString() }}</td></tr>
        <tr><td><strong>Check-out</strong></td><td>{{ $reservation->check_out->toDateString() }}</td></tr>
        <tr><td><strong>Nights</strong></td><td>{{ $reservation->nights }}</td></tr>
        <tr><td><strong>Guests</strong></td><td>{{ $reservation->guests }}</td></tr>
        <tr><td><strong>Guest name</strong></td><td>{{ $reservation->guest_name }}</td></tr>
        <tr><td><strong>Phone</strong></td><td>{{ $reservation->guest_phone }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $reservation->guest_email ?? '—' }}</td></tr>
        <tr><td><strong>Note</strong></td><td>{{ $reservation->guest_note ?? '—' }}</td></tr>
        <tr><td><strong>Promo</strong></td><td>{{ $reservation->promo_code ?? '—' }}</td></tr>
        <tr><td><strong>Nightly rate</strong></td><td>৳{{ number_format($reservation->nightly_rate) }}</td></tr>
        <tr><td><strong>Gross</strong></td><td>৳{{ number_format($reservation->gross) }}</td></tr>
        <tr><td><strong>Weekday discount</strong></td><td>৳{{ number_format($reservation->weekday_discount) }}</td></tr>
        <tr><td><strong>Promo discount</strong></td><td>৳{{ number_format($reservation->promo_discount) }}</td></tr>
        <tr><td><strong>Net</strong></td><td>৳{{ number_format($reservation->net) }}</td></tr>
        <tr><td><strong>VAT</strong></td><td>৳{{ number_format($reservation->vat) }}</td></tr>
        <tr><td><strong>Total</strong></td><td>৳{{ number_format($reservation->total) }}</td></tr>
        <tr><td><strong>Status</strong></td><td>{{ $reservation->status }}</td></tr>
        <tr><td><strong>Source</strong></td><td>{{ $reservation->source }}</td></tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: sans-serif; color: #222; line-height: 1.6;">
    <h2>Thank you — we've received your enquiry.</h2>

    <p>Hi {{ $reservation->guest_name }},</p>

    <p>
        Thank you — we've received your enquiry and will confirm within a day.
        Here are the details you sent us:
    </p>

    <table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
        <tr><td><strong>Reference</strong></td><td>{{ $reservation->reference }}</td></tr>
        <tr><td><strong>Stay</strong></td><td>{{ $reservation->stay->name }}</td></tr>
        <tr><td><strong>Check-in</strong></td><td>{{ $reservation->check_in->toFormattedDateString() }}</td></tr>
        <tr><td><strong>Check-out</strong></td><td>{{ $reservation->check_out->toFormattedDateString() }}</td></tr>
        <tr><td><strong>Nights</strong></td><td>{{ $reservation->nights }}</td></tr>
        <tr><td><strong>Guests</strong></td><td>{{ $reservation->guests }}</td></tr>
        <tr><td><strong>Total (incl. VAT)</strong></td><td>৳{{ number_format($reservation->total) }}</td></tr>
    </table>

    <p>
        We confirm your dates first, then send payment details for a deposit.
        The balance is settled with us directly.
    </p>

    <p>If anything above looks wrong, just reply to this email and we'll sort it out.</p>

    <p>— Bonomali Mangrove Resort</p>
</body>
</html>

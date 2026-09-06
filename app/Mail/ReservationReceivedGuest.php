<?php

namespace App\Mail;

use App\Models\Admin\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationReceivedGuest extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Reservation $reservation)
    {
    }

    public function build()
    {
        return $this->subject("We've received your enquiry — {$this->reservation->reference}")
            ->view('emails.reservation-received-guest');
    }
}

<?php

namespace App\Mail;

use App\Models\Admin\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationReceivedOffice extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Reservation $reservation)
    {
    }

    public function build()
    {
        return $this->subject("New reservation request — {$this->reservation->reference}")
            ->view('emails.reservation-received-office');
    }
}

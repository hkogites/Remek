<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $subject = 'Foglalás megerősítése – ' . ($this->data['destination_title'] ?? 'Utazás');

        return $this->subject($subject)
            ->view('emails.reservation_confirmation')
            ->with(['data' => $this->data]);
    }
}

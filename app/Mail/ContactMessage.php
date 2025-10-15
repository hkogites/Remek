<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $name = trim(($this->data['first_name'] ?? '').' '.($this->data['last_name'] ?? ''));

        return $this->subject('Kapcsolatfelvétel a weboldalról')
            ->replyTo($this->data['email'], $name ?: null)
            ->view('emails.contact')
            ->with(['data' => $this->data, 'name' => $name]);
    }
}

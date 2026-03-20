<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SmartVoyager - Foglalás státusz változás',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation-status-update',
            with: [
                'full_name' => $this->mailData['full_name'] ?? '',
                'email' => $this->mailData['email'] ?? '',
                'custom_message' => $this->mailData['message'] ?? '',
                'destination_title' => $this->mailData['destination_title'] ?? '',
                'status' => $this->mailData['status'] ?? 'pending',
                'admin_notes' => $this->mailData['admin_notes'] ?? null,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

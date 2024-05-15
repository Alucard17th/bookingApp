<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentStatusUpdatedClientsMail extends Mailable
{
    use Queueable, SerializesModels;
    private $receiverName;
    private $appointment;
    /**
     * Create a new message instance.
     */
    public function __construct($appointment, $receiverName)
    {
        //
        $this->receiverName = $receiverName;
        $this->appointment = $appointment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Status Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment-status-updated',
            with: [
                'receiverName' => $this->receiverName,
                'status' => $this->appointment->status == 'active' ? 'activated' : 'cancelled',
                'appointment' => $this->appointment
            ]
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

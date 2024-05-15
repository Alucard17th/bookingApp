<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $service;
    private $receiverName;
    /**
     * Create a new message instance.
     */
    public function __construct($service, $receiverName)
    {
        //
        $this->service = $service;
        $this->receiverName = $receiverName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Service Status Updated.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.service-status-updated',
            with: [
                'service' => $this->service,
                'status' => $this->service->is_active ? 'activated' : 'suspended',
                'receiverName' => $this->receiverName
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

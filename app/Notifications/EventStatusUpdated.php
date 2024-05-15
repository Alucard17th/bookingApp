<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventStatusUpdated extends Notification
{
    use Queueable;
    private $service;
    /**
     * Create a new notification instance.
     */
    public function __construct($service)
    {
        //
        $this->service = $service;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $body = 'The service ' . $this->service->name . ' status has been ';
        $body .= $this->service->is_active ? 'set to active' : 'suspended' . '.';
        return (new MailMessage)
            ->greeting('Hello!')
            ->subject('Your service status updated') // Set the subject line
            ->line($body)
            ->action('See details', url('/'))
            ->line('Thank you for using '.config('app.name').'!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
            'url' => route('services.show', $this->service->id),
            'message' => 'Service Status Updated for the service: ' . $this->service->name,
        ];
    }
}
